<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function postWithoutToken($endpoint,$data)
    {
        $url = env("BASE_API_URL").$endpoint;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url,$data);

        Log::info('response '.json_encode($response));

        return $response;
    }

    public function fetch($endpoint)
    {
        $url = env("BASE_API_URL").$endpoint;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withToken(session('token'))->get($url);

        return $response;
    }

    public function fetchWithoutToken($endpoint)
    {
        $url = env("BASE_API_URL").$endpoint;

        $response = Http::get($url);

        return $response;
    }

    public function postWithToken($endpoint,$data)
    {
        $url = env("BASE_API_URL").$endpoint;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withToken(session('token'))->post($url,$data);

        return $response;
    }
}
