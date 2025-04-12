<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatHistory;
use App\Models\TarotCard;

class ChatbotController extends Controller
{
    public function index(Request $request)
{
    $search = $request->query('search');
    $cards = TarotCard::when($search, function ($query, $search) {
        return $query->where('card_name', 'like', "%{$search}%")
                     ->orWhere('short_description', 'like', "%{$search}%");
    })->get();

    return view('chatbot', compact('cards'));
}

    public function ask(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'question' => 'required|string|max:255',
        ]);

        $question = $request->input('question');
        $apiKey = "iAtteKj8TSqUK4kdrHHC2QlIldEdfMjk";
        $apiUrl = "http://localhost:60074/chatbot/chatbot-demo/";
        $pathDatabase = "D:/thuctapdoan/chatbot_nop/api_base_public/utils/database/demo_2";

        // Gọi API
        $response = Http::withHeaders([
            'API-Key' => $apiKey,
        ])->asForm()->post($apiUrl, [
            'question' => $question,
            'path_database' => $pathDatabase,
        ]);

        // Lấy tất cả lá bài Tarot để hiển thị trong thư viện
        $cards = TarotCard::all();

        if ($response->successful()) {
            $data = $response->json();

            // Lưu lịch sử trò chuyện
            ChatHistory::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'user_name' => Auth::check() ? (Auth::user()->fullname ?? 'Khách') : 'Khách',
                'question' => $question,
                'answer' => $data['generation'],
            ]);

            // Trả về view với câu hỏi, câu trả lời, tài liệu và danh sách lá bài
            return view('chatbot', [
                'question' => $question,
                'generation' => $data['generation'],
                'documents' => $data['documents'] ?? [],
                'cards' => $cards,
            ]);
        } else {
            // Trả về view với thông báo lỗi và danh sách lá bài
            return view('chatbot', [
                'cards' => $cards,
                'error' => 'Có lỗi khi kết nối tới chatbot API.',
            ]);
        }
    }
}