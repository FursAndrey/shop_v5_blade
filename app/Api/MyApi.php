<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;

class MyApi
{
    public function getWithRelations(string $apiName, $page = null): array
    {
        if (is_null($page)) {
            $url = env('MY_API_URL').$apiName;
        } else {
            $url = env('MY_API_URL').$apiName.'?page='.$page;
        }
        
        $response = Http::acceptJson()->get($url);

        return [
            'status' => $response->status(),
            'body' => json_decode($response->body())
        ];
    }

    public function sendPost(string $apiName, array $queryParams): array
    {
        $response = Http::post(
            env('MY_API_URL').$apiName, 
            $queryParams
        );
        
        return [
            'status' => $response->status(),
            'body' => json_decode($response->body())
        ];
    }

    public function sendPut(string $apiName, int $elementId, array $queryParams): array
    {
        $response = Http::put(
            env('MY_API_URL').$apiName.'/'.$elementId, 
            $queryParams
        );
        
        return [
            'status' => $response->status(),
            'body' => json_decode($response->body())
        ];
    }

    public function sendDelete(string $apiName, int $elementId): array
    {
        $response = Http::delete(env('MY_API_URL').$apiName.'/'.$elementId);
        
        return [
            'status' => $response->status(),
            'body' => $response->body()
        ];
    }

    public function showItem(string $apiName, int $elementId): array
    {
        $response = Http::acceptJson()->get(env('MY_API_URL').$apiName.'/'.$elementId);
        
        return [
            'status' => $response->status(),
            'body' => json_decode($response->body())
        ];
    }
}
