@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Chỉnh sửa lá bài Tarot</h1>
    
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tarot-cards.update', $tarotCard->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="card_name">Tên lá bài *</label>
                    <input type="text" name="card_name" id="card_name" 
                           class="form-control" value="{{ $tarotCard->card_name }}" required>
                </div>
                
                <div class="form-group">
                    <label>Hình ảnh hiện tại</label><br>
                    <img src="{{ asset('storage/' . $tarotCard->image_path) }}" 
                         alt="{{ $tarotCard->card_name }}" 
                         style="max-width: 200px; height: auto;">
                </div>
                
                <div class="form-group">
                    <label for="image">Cập nhật hình ảnh (nếu muốn thay đổi)</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                
                <div class="form-group">
                    <label for="short_description">Mô tả ngắn *</label>
                    <textarea name="short_description" id="short_description" 
                              class="form-control" rows="3" required>{{ $tarotCard->short_description }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="detailed_meaning">Ý nghĩa chi tiết *</label>
                    <textarea name="detailed_meaning" id="detailed_meaning" 
                              class="form-control" rows="5" required>{{ $tarotCard->detailed_meaning }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="upright_meaning">Ý nghĩa xuôi *</label>
                    <textarea name="upright_meaning" id="upright_meaning" 
                              class="form-control" rows="5" required>{{ $tarotCard->upright_meaning }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="reversed_meaning">Ý nghĩa ngược *</label>
                    <textarea name="reversed_meaning" id="reversed_meaning" 
                              class="form-control" rows="5" required>{{ $tarotCard->reversed_meaning }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('tarot-cards.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>
@endsection