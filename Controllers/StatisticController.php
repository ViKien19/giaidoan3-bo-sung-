<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        // Lấy khoảng thời gian (week, month, year), mặc định là 'week'
        $period = $request->input('period', 'week'); 

        // Lấy dữ liệu thống kê theo khoảng thời gian
        $statistics = Statistic::query()
            ->when($period === 'week', function ($q) {
                return $q->whereBetween('date', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            })
            ->when($period === 'month', function ($q) {
                return $q->whereMonth('date', Carbon::now()->month)
                    ->whereYear('date', Carbon::now()->year);
            })
            ->when($period === 'year', function ($q) {
                return $q->whereYear('date', Carbon::now()->year);
            })
            ->orderBy('date')
            ->get();

        // Lấy top 10 câu hỏi phổ biến nhất
        $popularQuestions = DB::table('chat_histories')
            ->select('question', DB::raw('COUNT(*) as total'))
            ->groupBy('question')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Đếm số lượng user hoạt động trong khoảng thời gian
        $activeUsers = DB::table('chat_histories')
            ->select(DB::raw('COUNT(DISTINCT user_id) as active_users'))
            ->when($period === 'week', function ($q) {
                return $q->whereBetween('asked_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            })
            ->when($period === 'month', function ($q) {
                return $q->whereMonth('asked_at', Carbon::now()->month)
                    ->whereYear('asked_at', Carbon::now()->year);
            })
            ->when($period === 'year', function ($q) {
                return $q->whereYear('asked_at', Carbon::now()->year);
            })
            ->first();

        // Trả về view với các dữ liệu thống kê
        return view('admin.statistics.index', compact(
            'statistics', 
            'popularQuestions', 
            'period', 
            'activeUsers'
        ));
    }
}

