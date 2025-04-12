<?php

// File: app/Http/Controllers/ChatHistoryController.php
namespace App\Http\Controllers;

use App\Models\ChatHistory;
use Illuminate\Http\Request;

class ChatHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ChatHistory::query();

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('user_name', 'like', '%'.$request->search.'%')
                  ->orWhere('question', 'like', '%'.$request->search.'%');
            });
        }

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

        return view('admin.dashboard', compact('chatHistories'));
    }

    public function show($id)
    {
        $chatHistory = ChatHistory::findOrFail($id);

        return view('admin.chat_history.show', compact('chatHistory'));
    }
}