<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatHistory;
use App\Models\TarotCard;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Xử lý ChatHistory
        $query = ChatHistory::query();

        // Xử lý chi tiết khi có chat_id
        $chatHistory = null;
        if ($request->has('chat_id')) {
            $chatHistory = ChatHistory::findOrFail($request->input('chat_id'));
        }

        // Tìm kiếm theo từ khóa
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('user_name', 'like', '%' . $request->search . '%')
                  ->orWhere('question', 'like', '%' . $request->search . '%');
            });
        }

        // Lọc theo khoảng thời gian
        if ($request->has('period')) {
            switch ($request->period) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month);
                    break;
            }
        }

        $chatHistories = $query->orderBy('created_at', 'desc')->paginate(10);

        // Lấy danh sách Tarot Card
        $cards = TarotCard::all();

        if ($request->ajax()) {
            return view('admin.partials.chat_history_table', compact('chatHistories'))->render();
        }

        return view('admin.dashboard', compact('chatHistories', 'chatHistory', 'cards'));
    }
}