<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // Sửa namespace
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\TarotCardController;
use App\Http\Controllers\ChatHistoryController;
use App\Http\Controllers\ChatbotUsageController;
use App\Http\Controllers\AdminReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\AskTuviController;
use App\Http\Controllers\ChatbotController;
Route::get('/', [ChatbotController::class, 'index'])->name('home');
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');

// Route::get('/ask-tuvi', [AskTuviController::class, 'index'])->name('ask-tuvi');
// Route::post('/ask-tuvi', [AskTuviController::class, 'ask'])->name('ask-tuvi.submit');


// Kiểm tra kết nối database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Kết nối database thành công! Phiên bản MySQL: " . DB::connection()->getPdo()->getAttribute(PDO::ATTR_SERVER_VERSION);
    } catch (\Exception $e) {
        return "Không thể kết nối database: " . $e->getMessage();
    }
});

// Trang đăng nhập/đăng ký
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Trang chủ
Route::get('/home', function () {
    return view('home');
})->name('home');

// Các route yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    // Phân quyền chuyển hướng sau đăng nhập
    Route::get('/redirect', function () {
        $user = Auth::user();
        if ($user && $user->role_id === 1) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('chatbot');
    })->name('redirect');

    // Route chatbot
    Route::get('/chatbot', function () {
        return view('chatbot');
    })->name('chatbot');

    // Đăng xuất
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route riêng cho admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});

// API Resource cho user (Admin dùng để quản lý user)
Route::apiResource('users', UserController::class);

// QUÁN LÝ NGƯỜI DÙNG
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->withoutMiddleware('admin');

// QUÁN LÝ BÀI TAROT
Route::prefix('admin')->group(function () {
    Route::resource('tarot-cards', TarotCardController::class);
});

// QUÁN LÝ LỊCH SỬ TƯ VẤN
Route::prefix('admin')->group(function () {
    Route::get('/chat-history', [ChatHistoryController::class, 'index'])->name('chat-history.index');
    Route::get('/chat-history/{id}', [ChatHistoryController::class, 'show'])->name('chat-history.show');
});

// Thống kê và báo cáo
Route::prefix('admin')->group(function () {
    Route::get('/popular-questions', [ChatbotUsageController::class, 'popularQuestions'])->name('popular.questions');
    Route::get('/query-status', [ChatbotUsageController::class, 'queryStatus'])->name('query.status');
    Route::get('/usage', [ChatbotUsageController::class, 'usage'])->name('chatbot.usage');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/reports', [ChatbotUsageController::class, 'reportIndex'])->name('reports.index');
});

Route::prefix('admin/reports')->group(function () {
    Route::get('/usage', [AdminReportController::class, 'usageReport'])->name('reports.usage');
    Route::get('/popular-questions', [AdminReportController::class, 'popularQuestions'])->name('reports.popular_questions');
    Route::get('/query-status', [AdminReportController::class, 'queryStatus'])->name('reports.query_status');
});
Route::get('/chatbot', function () {
    $cards = \App\Models\TarotCard::all();
    return view('chatbot', compact('cards'));
});