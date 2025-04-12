<?php 

namespace App\Http\Controllers;
// use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChatbotUsageController extends Controller
{
    // Thống kê số lượt sử dụng chatbot theo ngày
    public function usageReport()
    {
        // Lấy số lượt sử dụng chatbot theo ngày
        $usageStats = DB::table('chatbot_usage')
                        ->select(DB::raw('DATE(timestamp) as date'), DB::raw('COUNT(*) as usage_count'))
                        ->groupBy(DB::raw('DATE(timestamp)'))
                        ->orderBy('date', 'desc')
                        ->get();

        return view('admin.reports.usage', compact('usageStats'));
    }

    // Thống kê các câu hỏi phổ biến
    public function popularQuestions()
    {
        // Lấy top 10 câu hỏi phổ biến
        $popularQuestions = DB::table('user_queries')
                               ->select('query', DB::raw('COUNT(*) as query_count'))
                               ->groupBy('query')
                               ->orderByDesc('query_count')
                               ->limit(10)
                               ->get();

        return view('admin.reports.popular_questions', compact('popularQuestions'));
    }

    // Thống kê tình trạng câu hỏi (hợp lệ/không hợp lệ)
    public function queryStatus()
    {
        // Lấy tình trạng câu hỏi hợp lệ/không hợp lệ
        $queryStatus = DB::table('user_queries')
                         ->select('is_valid', DB::raw('COUNT(*) as query_count'))
                         ->groupBy('is_valid')
                         ->get();

        return view('admin.reports.query_status', compact('queryStatus'));
    }
    public function chatHistory()
{
    $histories = DB::table('chat_histories')->latest()->paginate(20);
    return view('admin.chat-history.index', compact('histories'));
}
public function reportIndex()
{
    // Lấy dữ liệu thống kê nếu cần
    return view('admin.reports.index'); // File blade hiển thị
}
}
