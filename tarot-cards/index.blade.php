@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Quản lý bộ bài Tarot</h1>
    
    <div class="mb-4">
        <a href="{{ route('tarot-cards.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm lá bài mới
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tên lá bài</th>
                            <th>Mô tả ngắn</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cards as $card)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $card->image_path) }}" 
                                     alt="{{ $card->card_name }}" 
                                     style="width: 60px; height: auto;">
                            </td>
                            <td>{{ $card->card_name }}</td>
                            <td>{{ Str::limit($card->short_description, 50) }}</td>
                            <td>
                                <a href="{{ route('tarot-cards.edit', $card->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tarot-cards.destroy', $card->id) }}" 
                                      method="POST" 
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection