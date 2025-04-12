<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AskTuviController extends Controller
{
    public function index()
    {
        return view('ask-tuvi');
    }

    public function ask(Request $request)
    {
        $client = new Client();
        $apiKey = "keBnUlsYpv74n415ExQirFEcXzxluAr0";
        $question = $request->input('question');
        $ngaySinh = $request->input('ngay_sinh');
        $gioSinh = $request->input('gio_sinh');
        $cung = $request->input('cung');

        try {
            $response = $client->post('http://localhost:60074/api/llm/ask-tuvi', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'question' => $question,
                    'ngay_sinh' => $ngaySinh,
                    'gio_sinh' => $gioSinh,
                    'cung' => $cung,
                ],
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            return view('ask-tuvi', ['result' => $result['response'] ?? 'Có lỗi xảy ra']);
        } catch (\Exception $e) {
            return view('ask-tuvi', ['result' => 'Lỗi: ' . $e->getMessage()]);
        }
    }
}