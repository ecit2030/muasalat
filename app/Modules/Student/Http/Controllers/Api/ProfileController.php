<?php

namespace Modules\Student\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Services\LocalFileService;
use Illuminate\Validation\ValidationException;
use Modules\Code\Services\CodeService;
use Modules\Student\Entities\Student;
use Modules\Student\Http\Requests\Api\Auth\ChangeEmailRequest;
use Modules\Student\Http\Requests\Api\Auth\ChangePasswordRequest;
use Modules\Student\Http\Requests\Api\Auth\ChangePriceRequest;
use Modules\Student\Http\Requests\Api\Auth\SearchRequest;
use Modules\Student\Http\Requests\Api\Auth\SendCodeToChangeEmailRequest;
use Modules\Student\Http\Requests\Api\Auth\UpdateFcmTokenRequest;
use Modules\Student\Http\Requests\Api\Auth\UpdatePhoneRequest;
use Modules\Student\Http\Requests\Api\Auth\UpdateProfileRequest;
use Modules\Student\Transformers\Auth\CaptainModelResource;
use Modules\Student\Transformers\Auth\DriverModelResource;
use Modules\Student\Transformers\Auth\UserModelResource;
use Modules\Student\Transformers\StudentResource;


class ProfileController extends ApiController
{

    public function changePassword(ChangePasswordRequest $request)
    {

        $student = auth()->user();
        if ($request->old_password == $request->new_password) {
            throw ValidationException::withMessages([
                'new_password' => __('messages.the_new_password_must_be_different_from_the_old_password'),
            ]);
        }
        if (\Illuminate\Support\Facades\Hash::check($request->old_password, $student->password)) {
            $student->update([
                'password' => bcrypt($request->new_password),
            ]);
        } else {
            return $this->errorResponse(__('messages.old_password_is_not_correct'));
        }
        return $this->successResponse(
            StudentResource::make($student),
            __("messages.password_changed_successfully")
        );
    }


    public function changePhone(UpdatePhoneRequest $request, CodeService $codeService)
    {

        $title = t_('messages.change_phone_request');
        $message = t_('messages.you_have_requested_validation_code');

        $code = $codeService->sendCode($request->phone, User::class, $title, $message);

        return $this->successResponse($code, __('messages.code_sent_successfully'));
    }

    // public function toggleActivation()
    // {
    //     auth()->user()->update(['is_online' => !auth()->user()?->is_online]);

    //     return $this->successResponse(auth()->user(), __('messages.done successfully'));
    // }
public function toggleActivation(Request $request)
{
    $request->validate([
        'latitude' => 'required',
        'longitude' => 'required',
    ]);

    $user = auth()->user();

    $user->update([
        'is_online' => !$user->is_online,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
    ]);

    return $this->successResponse(
        $user,
        __('messages.done successfully')
    );
}

    public function editProfile(UpdateProfileRequest $request)
    {

        $user = auth()->user();
        $data = $request->validated();

        if (isset($data["ussid"])) {
            uploadMedia('ussid', $data["ussid"], $user);
            unset($data["ussid"]);
        }

        if (isset($data["avatar"])) {
            uploadMedia('avatar', $data["avatar"], $user);
            unset($data["avatar"]);
        }

        if (isset($data["driver_license"])) {
            uploadMedia('driverLicense', $data["driver_license"], $user);
            unset($data["driver_license"]);
        }

//        if (isset($data["vehicle_form"])) {
//            uploadMedia('vehicleForm', $data["vehicle_form"], $user->vehicle);
//            unset($data["vehicle_form"]);
//        }

//        if (isset($data["vehicle_license"])) {
//            uploadMedia('vehicleLicense', $data["vehicle_license"], $user->vehicle);
//            unset($data["vehicle_license"]);
//        }

//        if (isset($data["vehicle_ensurance"])) {
//            uploadMedia('vehicleEnsurance', $data["vehicle_ensurance"], $user->vehicle);
//            unset($data["vehicle_ensurance"]);
//        }

//        if (isset($data["vehicle_periodic"])) {
//            uploadMedia('vehiclePeriodic', $data["vehicle_periodic"], $user->vehicle);
//            unset($data["vehicle_periodic"]);
//        }

        if (isset($data["vehicle"])) {
            $user->vehicle->clearMediaCollection("vehicle");

            foreach ($data["vehicle"] as $vehicle) {
                $user->vehicle->addMedia($vehicle)->toMediaCollection("vehicle");
            }
            unset($data["vehicle"]);
        }


        $user->update($data);

        if ($user->hasRole("captain")) {
            $user->vehicle->update($data);
        }

        return $this->successResponse(
            $this->userResource($user),
            __('Updated successfully')
        );
    }

    public function changeEmailRequest(SendCodeToChangeEmailRequest $request, CodeService $codeService)
    {
        if (auth()->user()->email === $request->email) {
            return $this->errorResponse(__('messages.must_select_a_new_email'));
        }

        $title = t_('messages.change_email_request');
        $message = t_('messages.you_have_requested_validation_code');

        $code = $codeService->sendCode($request->email, User::class, $title, $message);

        return $this->successResponse($code, __('messages.code_sent_successfully'));
    }

    public function changeEmail(ChangeEmailRequest $request, CodeService $codeService)
    {
        if (auth()->user()->email === $request->email) {
            return $this->errorResponse(__('messages.must_select_a_new_email'));
        }

        if ($codeService->verifyCode($request->email, User::class, $request->code, true)) {
            auth()->user()->update([
                'email' => $request->email,
            ]);

            return $this->successResponse(
                $this->userResource(auth()->user()),
                __("messages.email_changed")
            );
        }

        return $this->errorResponse(__('messages.wrong_code'));
    }

    public function updateFcmToken(UpdateFcmTokenRequest $request)
    {
        $client = auth()->user();
        $client->updateFcm($request->fcm_token);

        return $this->successResponse(
            $this->userResource($client)
        );
    }

    public function changePrice(ChangePriceRequest $request)
    {
        $data = $request->validated();
        $data['update_price'] = 0;
        $user = auth()->user();
        tap($user)->update($data)->fresh();

        return $this->successResponse(
            ["data" => $this->userResource($user)]
        );
    }

    public function priceRange()
    {
        $price = setting('price');

        $data = [
            "otherMin" => data_get($price, 'other_min', '1'),
            "otherMax" => data_get($price, 'other_max', '10'),
            "talebatMin" => data_get($price, 'talebat_min', '1'),
            "talebatMax" => data_get($price, 'talebat_max', '10'),
        ];

        return $this->successResponse($data);
    }

    public function removeImage()
    {
        auth()->user()->clearMediaCollection("avatar");
        return sendResponse(__("messages.resource_deleted"));
    }

    function userResource($model)
    {
        $role = $model->roles()->first()->name;

        $resource = [
            "user" => UserModelResource::make($model),
            "captain" => CaptainModelResource::make($model),
            "driver" => DriverModelResource::make($model),
        ];

        return $resource[$role];
    }
}
