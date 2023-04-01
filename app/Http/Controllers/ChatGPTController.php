<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ChatGPTController extends Controller
{
    private $apiKey = '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';
    private $endpoint = 'https://api.openai.com/v1/chat/completions';

    public function getView() {
        return view('chatgpt.index');
    }

    public function getResponse(Request $request) {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Hello!',
                    ],
                ],
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
