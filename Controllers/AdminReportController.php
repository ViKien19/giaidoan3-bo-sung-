<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ChatbotUsage;
use App\Models\UserQuery;
use App\Models\ChatHistory;

class AdminReportController extends Controller
{
    public function usageReport()
{
    // Đếm số lần sử dụng chatbot theo ngày
    $usage = DB::table('chatbot_usage')
        ->selectRaw('DATE(used_at) as date, count(*) as total')
        ->groupByRaw('DATE(used_at)')
        ->orderBy('date', 'desc')
        ->get();

    return view('admin.reports.usage', compact('usage'));
}

public function popularQuestions()
{
    // Đếm số lần mỗi câu hỏi xuất hiện
    $questions = DB::table('user_queries')
        ->select('query', DB::raw('count(*) as total'))
        ->groupBy('query')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

    return view('admin.reports.popular_questions', compact('questions'));
}

public function queryStatus()
{
    // Đếm trạng thái câu hỏi hợp lệ và không hợp lệ
    $status = DB::table('user_queries')
        ->select('is_valid', DB::raw('count(*) as total'))
        ->groupBy('is_valid')
        ->get();

    return view('admin.reports.query_status', compact('status'));
}

public function chatHistory()
{
    // Lấy lịch sử trò chuyện và phân trang
    $history = DB::table('chat_histories')
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.chat-history.index', compact('history'));
}
}
