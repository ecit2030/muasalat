<?php

namespace App\Services;

class FcmService
{
    protected string $FCM_KEY;

    /**
     * construct the class with firebase token from .env file.
     *
     * @return void
     */
    public function __construct()
    {
        $this->FCM_KEY = env('FCM_KEY');
    }

    /**
     * build data to send in notification.
     *
     * @param  array  $data of title , body
     * @return array
     */
    private function getNotificationData($data)
    {
        return [
            'title'             => $data['title'],
            'body'              => $data['body'],
            'type'              => $data['type'] ?? '',
            'typeId'            => $data['typeId'] ?? null,
            'content-available' => 1,
            'sound'             => 'default',
            'type_id'           => 1,
        ];
    }

    /**
     * build request headers.
     *
     * @return array
     */
    private function getHeaders()
    {
        return [
            'Authorization' => 'key='.$this->FCM_KEY,
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * send request to fcm google apis.
     *
     * @param  array  $body
     * @return \GuzzleHttp\Psr7\Response
     */
    private function sendRequestToFcm($body) //: \GuzzleHttp\Psr7\Response
    {
        $client = new \GuzzleHttp\Client(['headers' => $this->getHeaders()]);

        $response = $client->post('https://fcm.googleapis.com/fcm/send', [
            'body' => json_encode($body),
        ]);
        // dd(json_decode($response->getBody()));
        //return $response;
    }

    /**
     * send tontification to more than 1 user.
     *
     * @param  array  $tokens of fcm tokens
     * @param  array  $data
     * @return void
     */
    public function sendToMulti($tokens, $data)
    {
        $tokens = array_filter($tokens);
        $body = [
            'data' => $this->getNotificationData($data),
            'notification' => $this->getNotificationData($data),
            'registration_ids' => $tokens,
        ];

        $this->sendRequestToFcm($body);
    }

    /**
     * send tontification to more than 1 user.
     *
     * @param  string  $token of fcm user
     * @param  array  $data
     * @return void
     */
    public function sendToOne($token, $data)
    {
        if ($token) {
            $body = [
                'data' => $this->getNotificationData($data),
                'notification' => $this->getNotificationData($data),
                'to' => $token,
            ];

            $this->sendRequestToFcm($body);
        }

        // dd(json_decode($res->getBody()));
    }
}
