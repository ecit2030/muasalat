<?php

namespace App\Services;

use Exception;
use Google_Client;
use GuzzleHttp\Client;

class SendFCMV2
{
    protected Client $client;
    protected string $serverKey;
    protected string $projectId;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->authenticate();
    }

    protected function authenticate(): void
    {
        $credentialsFilePath = public_path('fcm.json');

        if (!file_exists($credentialsFilePath)) {
            throw new Exception('Service account credentials file not found');
        }

        $credentials = json_decode(file_get_contents($credentialsFilePath), true);
        $this->projectId = $credentials['project_id'];


        $client = new Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        # Ensure the credentials are loaded
        $client->useApplicationDefaultCredentials();

        # Fetch the access token
        try {

            $token = $client->fetchAccessTokenWithAssertion();

            if (isset($token['error'])) {
                throw new Exception('Error fetching access token: ' . $token['error_description']);
            }

            if (!empty($token) && isset($token['access_token'])) {
                $this->serverKey = $token['access_token'];
            } else {
                throw new Exception('Failed to obtain access token');
            }
        } catch (Exception $e) {
            # Handle the exception
            throw new Exception('Error authenticating with Firebase: ' . $e->getMessage());
        }
    }

    public function sendNotification( $title, $body,$anotherData,$fcm)
    {
        # Get title and body according to user language

        $url = 'https://fcm.googleapis.com/v1/projects/' . $this->projectId . '/messages:send';

        $headers = [
            'Authorization' => 'Bearer ' . $this->serverKey,
            'Content-Type' => 'application/json; charset=UTF-8',
        ];


        try {
            foreach ($fcm as $f) {
                try {
                    $data = [
                        'message' => [
                            'token' => $f,
                            'notification' => [
                                'title' => $title,
                                'body' => $body,
                            ],
                            'android' => [
                                'notification' => [
                                    'sound' => 'car_sound.wav',
                                    'channel_id' => 'car_channel'  // Ensure sound is set for Android
                                ],
                            ],
                            'apns' => [
                                'payload' => [
                                    'aps' => [
                                        'sound' => 'car_sound.wav',  // Ensure sound is set for iOS
                                    ],
                                ],
                            ],
                            'data' => $anotherData
                        ],
                    ];
        
                    // Send the notification
                    $response = $this->client->post($url, [
                        'headers' => $headers,
                        'json' => $data,
                    ]);
        
                    // Log success response
                    \Log::info("Notification sent to token: $f", json_decode($response->getBody()->getContents(), true));
        
                } catch (\Exception $e) {
                    // Log the error but continue with the next token
                    \Log::error("Error sending notification to token: $f - " . $e->getMessage());
                    continue;  // Skip to the next token
                }
            }
        } catch (\Exception $e) {
            \Log::error("FCM general error: " . $e->getMessage());
            return false;
        }
        
    }
}
