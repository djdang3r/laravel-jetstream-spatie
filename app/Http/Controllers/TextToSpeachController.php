<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TextToSpeachController extends Controller
{
    public function generateVoice(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $text = $request->input('text');

        $apiUrl = 'https://api.minimaxi.chat/v1/t2a_v2?GroupId=' . env('T2A_GROUP_ID');
        $apiKey = env('T2A_GROUP_TOKEN');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($apiUrl, [
            'model' => 'speech-01-turbo',
            'text' => $text,
            'stream' => true,
            'voice_setting' => [
                'voice_id' => 'male-qn-qingse',
                'speed' => 1.0,
                'vol' => 1.0,
                'pitch' => 0
            ],
            'audio_setting' => [
                'sample_rate' => 32000,
                'bitrate' => 128000,
                'format' => 'mp3',
                'channel' => 1
            ]
        ]);

        if ($response->successful()) {
            Log::info('Response TTS: ', ['response' => $response]);

            return response()->stream(function () use ($response) {
                echo $response->body();
            }, 200, [
                'Content-Type' => 'audio/mpeg',
                'Content-Disposition' => 'attachment; filename="voice.mp3"',
            ]);
        }

        return response()->json(['error' => 'Failed to generate voice'], 500);
    }
}
