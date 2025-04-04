{{-- File: resources/views/admin/chat_history/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lịch Sử Tư Vấn</h2>
    
    <form method="GET" action="{{ route('chat-history.index') }}">
        {{-- Form tìm kiếm --}}
    </form>

    @isset($chatHistories) {{-- Kiểm tra biến tồn tại --}}
        <table class="table">
            <thead>
                <tr>
                    <th>Tên người dùng</th>
                    <th>Câu hỏi</th>
                    <th>Thời gian</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($chatHistories as $chat)
                    <tr>
                        <td>{{ $chat->user_name }}</td>
                        <td>{{ Str::limit($chat->question, 50) }}</td>
                        <td>{{ $chat->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('chat-history.show', $chat->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Không có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $chatHistories->links() }} {{-- Hiển thị phân trang --}}
    @else
        <div class="alert alert-warning">
            Không thể tải dữ liệu lịch sử tư vấn.
        </div>
    @endisset
</div>
@endsection