<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class ZoomService
{
    protected $client;
    protected $clientId;
    protected $clientSecret;
    protected $accountId;

    public function __construct()
    {
        $this->clientId = config('services.zoom.client_id');
        $this->clientSecret = config('services.zoom.client_secret');
        $this->accountId = config('services.zoom.account_id');
        $this->client = new Client(['base_uri' => 'https://api.zoom.us/v2/']);
    }

    protected function getAccessToken()
    {
        if (Cache::has('zoom_access_token')) {
            return Cache::get('zoom_access_token');
        }

        $response = (new Client())->post('https://zoom.us/oauth/token', [
            'query' => [
                'grant_type' => 'account_credentials',
                'account_id' => $this->accountId,
            ],
            'auth' => [$this->clientId, $this->clientSecret],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);

        Cache::put('zoom_access_token', $data['access_token'], $data['expires_in'] - 60);

        return $data['access_token'];
    }

    public function createMeeting($topic, Carbon $startTime, $hostEmail = null, $duration = 60)
    {
        $token = $this->getAccessToken();
        $hostEmail = $hostEmail ?: config('services.zoom.host_email');

        $response = $this->client->post("users/{$hostEmail}/meetings", [
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'topic' => $topic,
                'type' => 2,
                'start_time' => $startTime->toIso8601String(),
                'duration' => $duration,
                'timezone' => 'Asia/Beirut',
                'settings' => [
                    'join_before_host' => false,
                    'waiting_room' => true,
                    'host_video' => true,
                    'participant_video' => true,
                ],
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
