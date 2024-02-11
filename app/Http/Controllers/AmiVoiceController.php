<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AmiVoiceController extends Controller
{
    public function recognize(Request $request)
    {
        $apiKey = config('services.amivoice.api_key');
        dd($apiKey);
        $serverURL = config('services.amivoice.server_url');

        // $apiKeyと$serverURLを使用してAmiVoiceと対話できます
        // ...

        // 例: AmiVoiceにリクエストを送信
        $response = Http::post($serverURL, [
            'api_key' => $apiKey,
            // 他のパラメータ...
        ]);

        return $response->json();
    }
}
