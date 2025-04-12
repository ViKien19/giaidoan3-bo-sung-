<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔮 Chatbot Tarot</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset("images/background.png") }}');
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .chat-container, .library-container {
            max-width: 850px;
            margin: 60px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.92);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .btn {
            padding: 10px 20px;
            background: #7c4dff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn:hover {
            background: #5e35b1;
        }

        .response {
            margin-top: 30px;
            padding: 20px;
            background: #f1f1f1;
            border-radius: 10px;
        }

        .response h3 {
            color: #333;
        }

        .tarot-image {
            text-align: center;
            margin: 20px 0;
        }

        .tarot-image img {
            max-width: 200px;
        }

        ul {
            padding-left: 20px;
        }

        /* Thư viện Tarot - Cập nhật */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            margin: 0 10px;
            color: white; /* Chữ trắng */
            border: 2px solid rgba(255, 255, 255, 0.3); /* Viền mờ trắng */
            border-radius: 8px; /* Bo góc */
            transition: all 0.2s ease;
        }

        .tab.active {
        color: gold; /* Chữ vàng khi active */
        border: 2px solid gold; /* Viền vàng khi active */
        font-weight: bold;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

    /* Bố cục mới cho thư viện */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 5px; /* Giảm khoảng cách giữa các lá bài */
            margin-top: 20px;
            background: transparent; /* Nền trong suốt */
        }

        .card-preview {
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            padding: 0; /* Xóa padding */
            background: transparent !important; /* Nền trong suốt */
            border: none !important; /* Xóa viền */
            box-shadow: none !important; /* Xóa đổ bóng */
            border-radius: 0 !important; /* Xóa bo góc */
            position: relative; /* Cần thiết cho hiệu ứng */
            overflow: hidden; /* Giữ hiệu ứng gọn trong khung */
        }

        .card-preview:hover {
            transform: translateY(-5px) scale(1.02);
            transition: transform 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }


        .card-preview img {
            width: 100%;
            height: auto;
            border-radius: 8px !important;
            box-shadow: none !important; /* Xóa đổ bóng ảnh */
            border: none !important; /* Xóa viền ảnh */
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .card-preview h4,
        .card-preview .short-desc {
            display: none; /* Ẩn tên và mô tả lá bài */
        }
        .card-preview {
            position: relative; /* Cần cho hiệu ứng */
        }

        .card-preview:hover::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 3px solid gold;
            border-radius: 8px;
            box-shadow: 0 0 15px gold;
            pointer-events: none; /* Không ảnh hưởng tới click */
            animation: glow 0.3s ease-out;
        }

        @keyframes glow {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Chi tiết lá bài */
        .card-detail {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .card-detail.active {
            opacity: 1;
            visibility: visible;
        }

        .card-detail-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: fadeInUp 0.5s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #777;
        }

        .card-detail-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-detail-header img {
            width: 120px;
            height: auto;
            margin-right: 20px;
            border-radius: 5px;
        }

        .card-detail-info h3 {
            margin: 0 0 10px;
            color: #333;
        }

        .card-detail-body p {
            margin: 15px 0;
            line-height: 1.6;
        }

        .meaning-section {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .meaning-section h4 {
            margin-top: 0;
            color: #7c4dff;
        }

        .btn-logout {
            padding: 10px 20px; /* Giống tab */
            font-size: 18px; /* Giống tab */
            cursor: pointer;
            color: white; /* Giống tab */
            border: 2px solid rgba(255, 255, 255, 0.53); /* Viền giống tab */
            border-radius: 8px; /* Bo góc giống tab */
            background: transparent; /* Nền trong suốt */
            transition: all 0.2s ease; /* Hiệu ứng giống tab */
            margin-left: 10px;
            text-decoration: none;
        }

        .btn-logout:hover {
            color: gold; /* Màu hover giống tab active */
            border-color: gold; /* Viền vàng khi hover */
        }

        .header-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            position: relative;
        }

        .logout-tab {
            position: absolute;
            right: 20px;
            /* Các thuộc tính khác giống .tab */
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
            background: transparent;
        }

        .tab:hover {
            color: gold;
            border-color: gold;
        }

        .tab.active {
            color: gold;
            border: 2px solid gold;
            font-weight: bold;
        }
        .logout-tab {
            background: rgba(255, 71, 71, 0); /* Màu đỏ nhạt */
        }
        .logout-tab:hover {
            background: rgba(255, 71, 87, 0.3); /* Màu đỏ đậm hơn khi hover */
        }

        
    </style>
</head>
<body>
    <div class="header-wrapper">
    <div class="tabs">
        <div class="tab active" data-tab="chatbot">Chatbot</div>
        <div class="tab" data-tab="library">Thư viện Tarot</div>
    </div>
        <a href="http://127.0.0.1:8000/login" class="tab logout-tab">Đăng xuất</a>
    </div>

    <!-- Phần Chatbot (Giữ nguyên) -->
    
    <div class="chat-container tab-content active" id="chatbot">
        <h2 style="text-align: center;">🔮 Chatbot Tarot</h2>

        <form action="{{ route('chatbot.ask') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question"><strong>Nhập câu hỏi của bạn:</strong></label>
                <input type="text" name="question" id="question" value="{{ old('question') }}" required>
            </div>

            @error('question')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="text-center mt-3">
                <button type="submit" class="btn">Gửi</button>
            </div>
        </form>

        @if(isset($generation))
            <div class="response">
                <h3>Câu hỏi: {{ $question }}</h3>
                <p><strong>Trả lời:</strong></p>
                <div>{!! nl2br(e($generation)) !!}</div>
            </div>
        @endif

        @if($errors->has('error'))
            <div class="alert alert-danger mt-3">
                {{ $errors->first('error') }}
            </div>
        @endif
    </div>

    <!-- Phần Thư viện (Đã cập nhật) -->
    <div class="library-container tab-content" id="library">
        <h2 style="text-align: center;">📚 Thư viện lá bài Tarot</h2>
        
        @if($cards->isEmpty())
            <p style="text-align: center;">Hiện tại chưa có lá bài nào trong thư viện.</p>
        @else
            <div class="card-grid">
                @foreach($cards as $card)
                    <div class="card-preview" 
                         data-card-name="{{ $card->card_name }}"
                         data-image-path="{{ asset('storage/' . $card->image_path) }}"
                         data-short-desc="{{ $card->short_description }}"
                         data-detailed-meaning="{{ $card->detailed_meaning }}"
                         data-upright-meaning="{{ $card->upright_meaning }}"
                         data-reversed-meaning="{{ $card->reversed_meaning }}">
                        <img src="{{ asset('storage/' . $card->image_path) }}" alt="{{ $card->card_name }}">
                        <h4>{{ $card->card_name }}</h4>
                        <p class="short-desc">{{ $card->short_description }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Phần chi tiết lá bài (Ẩn ban đầu) -->
    <div class="card-detail" id="cardDetail">
        <div class="card-detail-content">
            <span class="close-btn">&times;</span>
            <div class="card-detail-header">
                <img id="detailCardImage" src="" alt="">
                <div class="card-detail-info">
                    <h3 id="detailCardName"></h3>
                    <p id="detailShortDesc" class="short-desc"></p>
                </div>
            </div>
            <div class="card-detail-body">
                <div class="meaning-section">
                    <h4>Ý nghĩa chi tiết</h4>
                    <p id="detailDetailedMeaning"></p>
                </div>
                <div class="meaning-section">
                    <h4>Ý nghĩa xuôi</h4>
                    <p id="detailUprightMeaning"></p>
                </div>
                <div class="meaning-section">
                    <h4>Ý nghĩa ngược</h4>
                    <p id="detailReversedMeaning"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Xử lý chuyển tab
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Xóa trạng thái active khỏi tất cả các tab và nội dung
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                // Thêm trạng thái active cho tab được click và nội dung tương ứng
                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            });
        });

        // Xử lý hiển thị chi tiết lá bài
        const cardPreviews = document.querySelectorAll('.card-preview');
        const cardDetail = document.getElementById('cardDetail');
        const closeBtn = document.querySelector('.close-btn');
        
        cardPreviews.forEach(preview => {
            preview.addEventListener('click', function() {
                // Lấy dữ liệu từ các thuộc tính data
                const cardName = this.getAttribute('data-card-name');
                const imagePath = this.getAttribute('data-image-path');
                const shortDesc = this.getAttribute('data-short-desc');
                const detailedMeaning = this.getAttribute('data-detailed-meaning');
                const uprightMeaning = this.getAttribute('data-upright-meaning');
                const reversedMeaning = this.getAttribute('data-reversed-meaning');
                
                // Điền dữ liệu vào modal
                document.getElementById('detailCardName').textContent = cardName;
                document.getElementById('detailCardImage').src = imagePath;
                document.getElementById('detailCardImage').alt = cardName;
                document.getElementById('detailShortDesc').textContent = shortDesc;
                document.getElementById('detailDetailedMeaning').textContent = detailedMeaning;
                document.getElementById('detailUprightMeaning').textContent = uprightMeaning;
                document.getElementById('detailReversedMeaning').textContent = reversedMeaning;
                
                // Hiển thị modal
                cardDetail.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        // Đóng modal
        closeBtn.addEventListener('click', function() {
            cardDetail.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Đóng khi click bên ngoài nội dung modal
        cardDetail.addEventListener('click', function(e) {
            if (e.target === this) {
                cardDetail.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>
</html>