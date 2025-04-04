@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-search mr-2"></i>Chi tiết lịch sử tư vấn
            </h4>
            <a href="{{ route('chat-history.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Quay lại
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-item">
                        <h5 class="info-label"><i class="fas fa-user mr-2"></i>Tên người dùng</h5>
                        <p class="info-value">{{ $chatHistory->user_name ?? 'Không xác định' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <h5 class="info-label"><i class="fas fa-clock mr-2"></i>Thời gian</h5>
                        <p class="info-value">{{ $chatHistory->created_at->format('H:i d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="info-item mb-4">
                        <h5 class="info-label"><i class="fas fa-question-circle mr-2"></i>Câu hỏi</h5>
                        <div class="info-value bg-light p-3 rounded">
                            {{ $chatHistory->question }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="info-item">
                        <h5 class="info-label"><i class="fas fa-comment-dots mr-2"></i>Câu trả lời</h5>
                        <div class="info-value bg-light p-3 rounded">
                            {!! nl2br(e($chatHistory->answer)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .info-item {
        margin-bottom: 1.5rem;
    }
    .info-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .info-value {
        font-size: 1rem;
        color: #212529;
        margin-bottom: 0;
    }
    .card-header {
        background-color: #f8f9fa !important;
    }
</style>
@endpush