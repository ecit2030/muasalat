<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Enums\Driver\WaslStatusEnum;
use App\Events\DriverUpdateLocationEvent;
use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Services\Auth\AuthService;
use App\Services\DriversActions;
use App\Support\Helper\SpreadhelperClass;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use Modules\Student\Http\Requests\Api\Auth\CompleteInfoRequest;
use Modules\Student\Http\Requests\Api\Auth\LoginRequest;
use Modules\Student\Http\Requests\Api\Auth\RegisterRequest;
use Modules\Student\Http\Requests\Api\Auth\ResetPasswordRequest;
use Modules\Student\Http\Requests\Api\Auth\SendCodeRequest;
use Modules\Student\Http\Requests\Api\Auth\VehicleRequest;
use Modules\Student\Http\Requests\Api\Auth\verifyChangePhoneCodeRequest;
use Modules\Student\Http\Requests\Api\Auth\VerifyCodeRequest;
use Modules\Student\Transformers\Auth\UserModelResource;
use Modules\Student\Transformers\Auth\CaptainModelResource;
use Modules\Student\Transformers\Auth\DriverModelResource;
use Modules\Vehicle\Models\UserVehicle;
use Modules\Vehicle\Models\VehicleBrand;
use Moltaqa\Wasl\ResultCodes;
use Moltaqa\Wasl\Wasl;
use Moltaqa\Wasl\WaslMissingDataException;

class AuthController extends ApiController
{
    private AuthService $authService;
    private $studentModel;
    private $UserModelResource;
    private $CaptainModelResource;
    private $DriverModelResource;

    public function __construct()
    {
        $this->studentModel = User::class;
        $this->UserModelResource = UserModelResource::class;
        $this->CaptainModelResource = CaptainModelResource::class;
        $this->DriverModelResource = DriverModelResource::class;
        $this->authService = new AuthService($this->studentModel);
    }

    public function getRegister()
    {
        $data = VehicleBrand::query()
            ->select("id", "name->" . requestLang() . " as localName")
            ->whereHas('models', function ($query) {
                $query->select("id", "name->" . requestLang() . " as localName", "vehicle_brand_id", "capacity")
                    ->whereHas('years', function ($query) {
                        $query->select("id", "year", "vehicle_model_id");
                    });
            })
            ->with(['models' => function ($query) {
                $query->select("id", "name->" . requestLang() . " as localName", "vehicle_brand_id", "capacity")
                    ->with(['years' => function ($query) {
                        $query->select("id", "year", "vehicle_model_id");
                    }]);
            }])->get();
        return $this->successResponse($data, "");
    }

    public function firebase()
    {

        $cars = UserVehicle::expiredLisences()->with(["user.deviceTokens"])->get();
        return collect(spread($cars->pluck("user.deviceTokens")))->unique("token")->pluck("token");
        # TODO removed fixed id
        $tokens = User::find(22)->sendableTokens;
        $user = User::find(22);
        $user->notify(new FcmNotification($tokens, request("title"), request("message")));
        return $this->successResponse("notify sent ;) ", "");
    }

    public function register(RegisterRequest $request)
    {
        $title = t_("messages.validate_register");
        $message = t_("messages.you_have_requested_to_validate_your_registration_on_mausalat");
        $user = $this->authService->register($request);
        if (!is_null($user)) {
            $code = $this->authService->sendVerficationCode($request->phone, $title, $message);
            $data = [
                "name" => $user->name,
                "email" => (string)$user->email,
                "phone" => $user->phone,
                "role" => $user->roles()->first()->name,
                "token" => $user->createToken('tokens')->plainTextToken,
                "code" => $code->code,
                "status" => $user->status,
                "active" => $user->is_active,
                "username" => $user->username,
                "full_name" => $user->full_name
            ];
            return $this->successResponse($data, __('messages.registered_successfully'));
        } else {
            return $this->errorResponse(__('messages.registration_failed'));
        }
    }

    public function login(LoginRequest $request)
    {
        [$user, $token] = $this->authService->login($request->validated());
        if ($user->hasRole('captain')) {
            if ($request->captain_type == 'organization' && !$user->driverOrg()->exists()) {
                return $this->errorResponse(__('Incorrect Data'));
            }
            if ($request->captain_type != 'organization' && $user->driverOrg()->exists()) {
                return $this->errorResponse(__('Incorrect Data'));
            }
        }

        return $this->successResponse([
            'data' => $this->userResource($user),
            'token' => $token,
        ]);
    }

    function completeInfo(CompleteInfoRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        uploadMedia('ussid', $data["ussid"], $user);
        if ($request->has("avatar")) {
            uploadMedia('avatar', $data["avatar"], $user);
        }
        uploadMedia('driverLicense', $data["driver_license"], $user);
        $data["status"] = "complete_vehicle";
        tap($user)->update($data)->fresh();

        return $this->successResponse($this->userResource($user));
    }

    function completeVehicle(VehicleRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $rejections = [];
//        $isProcessed = DB::transaction(function () use (&$user, $data, $request, &$rejections) {
        $isProcessed = false;
        $data["status"] = "pending";
        $data["driver_id"] = $user->id;
        $vehicleRecord = $user->vehicle()->create($data);
        tap($user)->update($data)->fresh();
//        uploadMedia('vehicleForm', $request["vehicle_form"], $user->vehicle);
        uploadMedia('vehicleLicense', $request["vehicle_license"], $user->vehicle);
        uploadMedia('vehicleEnsurance', $request["vehicle_ensurance"], $user->vehicle);
//        uploadMedia('vehiclePeriodic', $request["vehicle_periodic"], $user->vehicle);
        foreach ($request["vehicle"] ?? [] as $vehicle) {
            $user->vehicle->addMedia($vehicle)->toMediaCollection("vehicle");
        }
//            if (!is_null($vehicleRecord)) {
//                $checkResponse = Wasl::getInstance()->driverCheckEligibility($user->ussid_number);
//                # Driver not registered or an error in data
//                $decodedCheckResponse = json_decode(json_encode($checkResponse->getData()), true);
//                switch ($decodedCheckResponse['status']) {
//                    case 200:
//                        if (!is_null($decodedCheckResponse['body'])) {
//                            if ($decodedCheckResponse['body']['driverEligibility'] == "INVALID") {
//                                $rejections = $this->extractRejectionReasons($decodedCheckResponse['body']);
//                                tap($user)->update([
//                                    'wasl_status' => WaslStatusEnum::invalid(),
//                                    'wasl_rejections' => $rejections,
//                                ])->fresh();
//                            } else if ($decodedCheckResponse['body']['driverEligibility'] == "PENDING") {
//                                tap($user)->update(['wasl_status' => WaslStatusEnum::pending()])->fresh();
//                            } else {
//                                tap($user)->update(['wasl_status' => WaslStatusEnum::valid()])->fresh();
//                            }
//                        } else {
//                            tap($user)->update(['wasl_status' => WaslStatusEnum::failed()])->fresh();
//                        }
//                        $isProcessed = true;
//                        break;
//                    case 400:
//                        if (!is_null($decodedCheckResponse['body'])) {
//                            if ($decodedCheckResponse['body']['resultCode'] == ResultCodes::DRIVER_NOT_FOUND) {
//                                tap($user)->update(['wasl_status' => WaslStatusEnum::invalid()])->fresh();
//                            }
//                            if (is_array($decodedCheckResponse['body']['resultCode'])) {
//                                $rejections = array_merge($rejections, $decodedCheckResponse['body']['resultCode']);
//                            } else {
//                                array_push($rejections, $decodedCheckResponse['body']['resultCode']);
//                            }
//                        } else {
//                            tap($user)->update(['wasl_status' => WaslStatusEnum::failed()])->fresh();
//                        }
//                        $isProcessed = true;
//                        break;
//                    default:
//                        throw new WaslMissingDataException();
//                        break;
//                }
//            }
//            return $isProcessed;
//        }, 3);
//        if (!$isProcessed)
//            return $this->errorResponse(__('Failed to Complete Vehicle registration'));
        tap($user)->update(['wasl_status' => WaslStatusEnum::valid()])->fresh();

        $tokens = $user->sendableTokens;
        $user->notify(new FcmNotification($tokens, t_('registration request'), t_('your registration request waiting for processing')));
        switch ($user->wasl_status) {
            case WaslStatusEnum::valid():
                $message = [
                    __('Valid at WASL')
                ];
                break;
            case WaslStatusEnum::invalid():
                $message = [
                    __('Invalid at WASL')
                ];
                if (!empty($rejections)) {
                    foreach ($rejections as &$rejection) {
                        $rejection = trans('moltaqa-wasl::messages.' . $rejection);
                    }
                    $message = array_merge($message, $rejections);
                }
                break;
            default:
                $message = [
                    __('Failed to obtain status from WASL')
                ];
        }
        return $this->successResponse($this->userResource($user), $message);
    }

    public function profile()
    {
        return $this->successResponse($this->userResource(auth()->user()));
    }

    public function updateLocation(Request $request)
    {
        auth()->user()?->update($request->all());

        $activeTrips = auth()->user()?->driverTrips()
            ->where('parent_id', 0)
            ->where('is_canceled', 0)
            ->whereNotNull('start_at')
            ->whereNull('end_at')
            ->whereHas('report', function ($q) {
                $q->where('is_paid', 1);
            })->get();

        foreach ($activeTrips as $trip) {
            $distance = (new DriversActions())->calcDistance(
                auth()->user()?->latitude,
                auth()->user()?->longitude,
                $trip->destination['lat'],
                $trip->destination['lng'],
            );
            $sourceDistance = (new DriversActions())->calcDistance(
                auth()->user()?->latitude,
                auth()->user()?->longitude,
                $trip->origin['lat'],
                $trip->origin['lng'],
            );
            $driverLocationNow = [
                'lat' => auth()->user()?->latitude,
                'lng' => auth()->user()?->longitude
            ];
            event(new DriverUpdateLocationEvent($trip, $distance,$driverLocationNow,$sourceDistance));
        }

        return sendResponse(__('messages.location updated successfully'));
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->deviceTokens()->delete();
        auth('sanctum')->user()->currentAccessToken()->delete();
//        [$id, $token] = explode('|', $request->header('Authorization'), 2);
//        PersonalAccessToken::findToken($token)->delete();
        return $this->successResponse([
            'message' => __('messages.logout_successfully'),
        ]);
    }

    //send forget codew
    public function sendCode(SendCodeRequest $request)
    {
        $type = $request->type;
        if (!$request->filled('type')) {
            $type = 'phone';
        }
        $user = User::when($type == 'phone', function ($q) use ($request) {
            $q->where('phone', $request->phone);
        })->when($type == 'email', function ($q) use ($request) {
            $q->where('email', $request->email);
        })->first();

        if($request->user_type == 'client' && $user->hasRole('captain')){
            return $this->errorResponse(__('Incorrect Data'));
        }elseif($request->user_type == 'captain' && $user->hasRole('client')){
            return $this->errorResponse(__('Incorrect Data'));
        }

        if ($user->status == "pending") {
            $message = t_("messages.admin_still_revising");
            throw new HttpResponseException(sendError($message, ["account is pending" => [$message]]));
        }

        if (!$user->is_active && $user->status == "active") {
            $message = t_("messages.acc_is_deactivated");
            throw new HttpResponseException(sendError($message, ["account is deactive" => [$message]]));
        }

        $title = t_('messages.change_password_request');
        $message = t_('messages.you_have_requested_validation_code');
        $data = $request->all();
        $data['type'] = $type;

        $code = $this->authService->sendVerficationCodeUsingMailOrPhone($data, $title, $message);
        return $this->successResponse($code, __('messages.code_sent_successfully'));
    }

    //verify forget code
    public function verifyCode(VerifyCodeRequest $request)
    {
        $this->authService->verifyCode($request->validated(), false);

        $user = $this->studentModel::when($request->type == 'phone', function ($q) use ($request) {
            $q->where('phone', $request->phone);
        })->when($request->type == 'email', function ($q) use ($request) {
            $q->where('email', $request->email);
        })->first();

        if ($user->roles()->first()->name == "captain" && $user->vehicle()->count() == 0) {
            $user->update([
                'phone_verified_at' => Carbon::now(),
                'status' => "complete_personal",
//                'phone' => $request->phone
            ]);
        } else {
            $user->update([
                'phone_verified_at' => Carbon::now(),
                'status' => "active",
//                'phone' => $request->phone
            ]);
        }

        $token = $user->createToken('tokens')->plainTextToken;


        return $this->successResponse(
            [
                'user' => $this->userResource($user),
                'code' => $request->code,
                'token' => $token,
            ]
        );
    }

    //verify forget code
    public function verifyChangePhoneCode(verifyChangePhoneCodeRequest $request)
    {
        $data = $request->validated();
        $this->authService->verifyCode($data, false);
        $user = auth()->user();

        $user->update([
            'phone_verified_at' => Carbon::now(),
            'status' => "active",
            'phone' => $request->phone
        ]);

        return $this->successResponse(
            [
                'user' => $this->userResource(auth()->user()),
            ]
        );
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $type = $request->type;
        if (!$request->filled('type')) {
            $type = 'phone';
        }
        $data = $request->validated();
        $data['type'] = $type;
        [$user, $token] = $this->authService->resetPassword($data);
        if ($user) {
            return $this->successResponse([
                'user' => $this->userResource($user),
                'token' => $token,
            ], __("messages.password_changed_successfully"));
        }
    }

    public function deleteAcc()
    {
        $user = auth()->user()->load('captainTracks.trips');
        if ($user->captainTracks?->isEmpty() || $user->captainTracks?->trips?->isEmpty()) {
            $user->captainTracks()->delete();
            $user->delete();
            return $this->successResponse(__("messages.account_has_been_deleted_successfully"));
        } else {
            return $this->errorResponse(__("messages.failed_to_delete_account"), null, 400);
        }
    }

    function userResource($model)
    {
        $role = $model->roles()->first()->name;

        $resource = [
            "user" => $this->UserModelResource::make($model),
            "captain" => $this->CaptainModelResource::make($model),
            "driver" => $this->DriverModelResource::make($model),
        ];

        return $resource[$role];
    }

    public function letters(Request $request)
    {
        return $this->successResponse(Wasl::getInstance()->getVehiclePlateLetters(), __("messages.data_found"));
    }

    protected function extractRejectionReasons($data): array
    {
        $rejectionReasons = [];
        // Check if the current data is an array
        if (is_array($data) || is_object($data)) {
            // Iterate over each item in the array or each property in the object
            foreach ($data as $key => $value) {
                // Check if the current key is 'rejectionReasons'
                if ($key === 'rejectionReasons') {
                    // If so, add the value to the $rejectionReasons array
                    $rejectionReasons = array_merge($rejectionReasons, $value);
                } else {
                    // Recursively call the function for each item or property
                    $rejectionReasons = array_merge($rejectionReasons, extractRejectionReasons($value));
                }
            }
        }
        return $rejectionReasons;
    }
}
################## register driver at wasl ########################
//                            $driverData = [
//                                "driver" => [
//                                    "identityNumber" => (string)$user->ussid_number,
//                                    "dateOfBirthGregorian" => (string)$user->date_of_birth,
//                                    "emailAddress" => (string)$user->email ?? '',
//                                    "mobileNumber" => (string)"+966".ltrim($user->phone, '0'),
//                                ]
//                            ];
//                            $letters = mb_str_split($user->vehicle->vehicle_letter);
//                            $vehicleData = [
//                                "vehicle" => [
//                                    "sequenceNumber" => str_pad((string)$user->vehicle->sequence_number, 10, '0', STR_PAD_LEFT),
//                                    "plateLetterRight" => (string)$letters[0],
//                                    "plateLetterMiddle" => (string)$letters[1],
//                                    "plateLetterLeft" => (string)$letters[2],
//                                    "plateNumber" => (string)$user->vehicle->vehicle_number,
//                                    "plateType" => "1"
//                                ]
//                            ];
//                            info(array_merge($driverData,$vehicleData));
//                            $registrationResponse = Wasl::getInstance()->registerDriverAndVehicle($driverData,$vehicleData,true);
//                            info(json_encode($registrationResponse->getData()));
//                            # try to register driver
//                            $decodedRegistrationResponse = json_decode(json_encode($registrationResponse->getData()),true);
//                            switch($decodedRegistrationResponse['status']){
//                                case 200:
//                                    tap($user)->update(['wasl_status' => WaslStatusEnum::processing()])->fresh();
//                                    $isProcessed = true;
//                                    break;
//                                default:
//                                    throw new WaslMissingDataException();
//                                    break;
//                            }