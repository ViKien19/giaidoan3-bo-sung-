@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Thêm lá bài Tarot mới</h1>
    
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tarot-cards.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="card_name">Tên lá bài *</label>
                    <input type="text" name="card_name" id="card_name" 
                           class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="image">Hình ảnh *</label>
                    <input type="file" name="image" id="image" 
                           class="form-control-file" required>
                </div>
                
                <div class="form-group">
                    <label for="short_description">Mô tả ngắn *</label>
                    <textarea name="short_description" id="short_description" 
                              class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="detailed_meaning">Ý nghĩa chi tiết *</label>
                    <textarea name="detailed_meaning" id="detailed_meaning" 
                              class="form-control" rows="5" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="upright_meaning">Ý nghĩa xuôi *</label>
                    <textarea name="upright_meaning" id="upright_meaning" 
                              class="form-control" rows="5" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="reversed_meaning">Ý nghĩa ngược *</label>
                    <textarea name="reversed_meaning" id="reversed_meaning" 
                              class="form-control" rows="5" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('tarot-cards.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>
@endsection