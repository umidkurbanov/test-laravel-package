<?php

namespace AreaWeb\LaravelPackage;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PCD
{
    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    private function getToken()
    {
        $data = [
            'grant_type' => 'password',
            'username' => $this->username,
            'password' => $this->password,
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode("kb062iDx9oMtv8d17f5bsJqYaDga:etIASte_pYQJckWXc5ofpfKKrHUa")
        ])->post('https://rmp-iskm.egov.uz:9444/oauth2/token', $data);

        return json_decode($response->body());
    }

    public function getDocInfo($pin, $birth_date)
    {
        $data = [
            'transaction_id' => rand(100_000_000_000_000, 999_999_999_999_999),
            'is_consent' => 'Y',
            'sender_pinfl' => (string)$pin,
            'langId' => 3,
            'document' => 'AB1234567',
            'birth_date' => (string)$birth_date,
            'pinpp' => (string)$pin,
            'is_photo' => 'Y',
            'Sender' => 'P'
        ];

        $response = Http::asJson()
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getToken()->access_token
            ])
            ->withBody(json_encode($data), 'application/json')
            ->post('https://rmp-apimgw.egov.uz:8243/gcp/docrest/v1');

        if ($response->status() != 200)
            abort(Response::HTTP_METHOD_NOT_ALLOWED, json_decode($response->body())->message .
                '. ' . json_decode($response->body())->description);

        $data = $response->body();
        return json_decode($data->data[0]);
    }
}