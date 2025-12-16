<?php

namespace App\Traits;

use App\Helpers\Code;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Laravel\Sanctum\PersonalAccessToken;

trait ApiResponse
{
    protected function successResponse($data, $msg = null, $code = 200)
    {
        return response()->json(
            $this->dataArray(true, $msg ?? t_('Success'), $data),
            $code
        );
    }

    protected function errorResponse($msg = null, $data = null, $code = 200, $errCode = Code::VALIDATION)
    {
        $message = $msg;
        if (is_array($msg)) {
            $message = implode(', ', $msg);
        } else {
            if ($msg == '' || $msg == null) {
                $message = t_('Error');
            }
        }

        return response()->json(
            $this->dataArray(false, $message, $data, $errCode),
            $code
        );
    }

    private function statusMap($errCode)
    {
        return match ($errCode) {
            Code::NO_ERROR => 200,
            Code::VALIDATION => 400,
            Code::NOT_AUTHENICATED => 401,
            Code::NOT_VERIFIED => 400,
            Code::NOT_FOUND => 404,
            default => 200,
        };
    }

    protected function dataArray($status = true, $messages = null, $data = null, $errCode = Code::NO_ERROR)
    {
        return [
            'success'             => $status,
            'errorCode'           => $errCode,
            'status'              => $this->statusMap($errCode),
            'notificationsCount'  => $this->getNotificationCount(),
            'messages'            => $messages,
            'data'                => $data,
        ];
    }

    public function getUser()
    {
        $hashedTooken = request()->bearerToken();
        $token = PersonalAccessToken::findToken($hashedTooken ?? '');
        $user = $token?->tokenable;

        if (request('phone') != null ) {
            $user1 = User::where([
                'phone' => request('phone')
            ])->first();

            return $user ?? $user1 ?? null;
        }
    }

    public function getNotificationCount(): int
    {
        $user = $this->getUser();
        return $user ? $user->unreadNotifications()->count() : 0;
        // return $user ? $user->unreadNotifications()->groupBy('notifiable_type')->count() : 0;
    }

    public function paginateUtils(\Illuminate\Pagination\LengthAwarePaginator $pagination)
    {
        return [
            'total'          => $pagination->total(),
            'count'          => $pagination->count(),
            'per_page'       => $pagination->perPage(),
            'current_page'   => $pagination->currentPage(),
            'total_pages'    => $pagination->lastPage(),
            'has_more_pages' => $pagination->hasMorePages(),
        ];
    }
}
