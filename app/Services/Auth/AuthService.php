<?php

namespace App\Services\Auth;

use App\Enums\General\RolesEnum;
use App\Models\User;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Modules\Code\Services\CodeService;

class AuthService
{
    protected CodeService $codeService;
    protected string $userModel;

    public function __construct(string $userModel)
    {
        $this->userModel = $userModel;
        $this->codeService = new CodeService();
    }

    public function sendVerficationCode($phone, $title, $message)
    {
        return $this->codeService->sendCode($phone, $this->userModel, $title, $message);
    }

    public function sendVerficationCodeUsingMailOrPhone($data, $title, $message)
    {
        return $this->codeService->sendCodeUsingMailOrPhone($data, $this->userModel, $title, $message);
    }

    public function verifyCode(iterable $data, $deleteCode = true)
    {
        if ($this->codeService->verifyCodeUsingMailOrPhone(
            $data,
            $this->userModel,
            $data['code'] ?? "", $deleteCode
        )) {
            return true;
        }
        throw new HttpResponseException(sendError(__('messages.you_dont_have_a_valid_code'), ["please send code first" => __('messages.you_dont_have_a_valid_code')]));
    }
 
    public function register($request)
    {
        $data = $request->all();

        if ($data["role"] == "captain") {
            $data["is_active"] = false;
        }


        $data["status"] = "verify_code";
        $data['password'] = bcrypt($data['password']);
        $user = $this->userModel::create($data);

        if ($request->has("avatar")) {
            uploadMedia('avatar', $data["avatar"], $user);
        }

        $user->assignRole($data["role"]);
        return User::find($user->id);
    }

    public function login(iterable $data)
    {
        $user = $this->userModel::where([
            'phone' => $data['phone']
        ])->first();
        if ($user && \Illuminate\Support\Facades\Hash::check($data['password'], $user->password)) {
            // $user->tokens()->delete();
            $moderator = $user->hasRole("moderator");
            $organization = $user->hasRole("organization");
            $admin = $user->hasRole("admin");

            if ($moderator || $organization || $admin || $user->roles()->first()->name != $data["role"]) {
                throw new HttpResponseException(sendError(__('messages.cant_login_from_here'), ["auth" => [__('messages.cant_login_from_here')]]));
            }

            $token = $user->createToken('tokens')->plainTextToken;

            $tokenExists = $user->deviceTokens()->whereToken($data["device_token"])->count();

            if (!$tokenExists) {
                $user->deviceTokens()->create([
                    "token" => $data["device_token"]
                ]);
            }

            if ($user->status == "pending") {
                $message = t_("messages.admin_still_revising");
                throw new HttpResponseException(sendError($message, ["account is pending" => [$message]]));
            }

            if (!$user->is_active && $user->status == "active") {
                $message = t_("messages.acc_is_deactivated");
                throw new HttpResponseException(sendError($message, ["account is deactive" => [$message]]));
            }

            $user->login_count += 1;
            $user->last_login = Carbon::now();
            $user->save();

            return [$user, $token];
        }
        throw new HttpResponseException(sendError(__('auth.failed'), ['email' => [__('auth.failed')]]));
    }

    public function resetPassword(iterable $data)
    {
        $user = $this->userModel::when($data['type'] == 'phone', function ($q) use ($data) {
            $q->where('phone', $data['phone']);
        })->when($data['type'] == 'email', function ($q) use ($data) {
            $q->where('email', $data['email']);
        })->first();

        $user?->update([
            'password' => bcrypt($data['password']),
        ]);
        return [$user, $user->createToken('tokens')->plainTextToken];
    }
}
