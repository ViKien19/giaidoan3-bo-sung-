<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Vũ Trụ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Space+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(ellipse at bottom, #1B2735 0%, #090A0F 100%);
            color: #ffffff;
            background-attachment: fixed;
            font-family: 'Space Mono', monospace;
            overflow-x: hidden;
            height: 100vh;
            margin: 0;
        }

        /* Hiệu ứng sao băng */
        @keyframes animStar {
            from { transform: translateY(0); }
            to { transform: translateY(-2000px); }
        }
        
        /* Tạo các ngôi sao */
        .stars, .stars2, .stars3 {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .stars { background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="10" cy="10" r="0.5" fill="white" opacity="0.8"/><circle cx="20" cy="20" r="0.7" fill="white" opacity="0.8"/><circle cx="30" cy="30" r="0.4" fill="white" opacity="0.8"/><circle cx="40" cy="40" r="0.6" fill="white" opacity="0.8"/><circle cx="50" cy="50" r="0.5" fill="white" opacity="0.8"/><circle cx="60" cy="60" r="0.3" fill="white" opacity="0.8"/><circle cx="70" cy="70" r="0.8" fill="white" opacity="0.8"/><circle cx="80" cy="80" r="0.4" fill="white" opacity="0.8"/><circle cx="90" cy="90" r="0.6" fill="white" opacity="0.8"/></svg>') repeat;
            animation: animStar 100s linear infinite;
        }
        
        .stars2 { background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="10" cy="10" r="0.3" fill="white" opacity="0.5"/><circle cx="20" cy="20" r="0.5" fill="white" opacity="0.5"/><circle cx="30" cy="30" r="0.2" fill="white" opacity="0.5"/><circle cx="40" cy="40" r="0.4" fill="white" opacity="0.5"/><circle cx="50" cy="50" r="0.3" fill="white" opacity="0.5"/><circle cx="60" cy="60" r="0.1" fill="white" opacity="0.5"/><circle cx="70" cy="70" r="0.6" fill="white" opacity="0.5"/><circle cx="80" cy="80" r="0.2" fill="white" opacity="0.5"/><circle cx="90" cy="90" r="0.4" fill="white" opacity="0.5"/></svg>') repeat;
            animation: animStar 150s linear infinite;
            opacity: 0.7;
        }
        
        .stars3 { background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="10" cy="10" r="0.2" fill="white" opacity="0.3"/><circle cx="20" cy="20" r="0.3" fill="white" opacity="0.3"/><circle cx="30" cy="30" r="0.1" fill="white" opacity="0.3"/><circle cx="40" cy="40" r="0.2" fill="white" opacity="0.3"/><circle cx="50" cy="50" r="0.1" fill="white" opacity="0.3"/><circle cx="60" cy="60" r="0.05" fill="white" opacity="0.3"/><circle cx="70" cy="70" r="0.4" fill="white" opacity="0.3"/><circle cx="80" cy="80" r="0.1" fill="white" opacity="0.3"/><circle cx="90" cy="90" r="0.2" fill="white" opacity="0.3"/></svg>') repeat;
            animation: animStar 200s linear infinite;
            opacity: 0.5;
        }

        /* Tinh vân */
        .nebula {
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
            opacity: 0.4;
        }
        
        .nebula-1 {
            background: radial-gradient(circle, #4e3b8a, transparent 70%);
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
        }
        
        .nebula-2 {
            background: radial-gradient(circle, #3b5b8a, transparent 70%);
            bottom: -150px;
            left: -100px;
            width: 600px;
            height: 600px;
        }
        
        .nebula-3 {
            background: radial-gradient(circle, #8a3b4e, transparent 70%);
            top: 50%;
            left: 30%;
            width: 400px;
            height: 400px;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(100, 149, 237, 0.2);
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(100, 149, 237, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                          rgba(138, 43, 226, 0.1) 0%, 
                          rgba(75, 0, 130, 0.1) 50%, 
                          rgba(0, 191, 255, 0.1) 100%);
            z-index: -1;
            border-radius: 15px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #7df9ff;
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 3px;
            position: relative;
            text-shadow: 0 0 10px rgba(125, 249, 255, 0.5);
        }

        .login-title .planet-icon {
            color: #7df9ff;
            transition: all 0.7s ease;
            text-shadow: 0 0 10px rgba(125, 249, 255, 0.7);
            display: inline-block;
            margin-right: 15px;
            font-size: 1.5em;
        }

        .login-container:hover .planet-icon {
            color: #ffffff;
            text-shadow: 0 0 20px #ffffff, 0 0 40px rgba(125, 249, 255, 0.8);
            transform: rotate(20deg) scale(1.3);
            animation: spaceGlow 2s infinite alternate;
        }

        @keyframes spaceGlow {
            0% { text-shadow: 0 0 10px rgba(125, 249, 255, 0.7); }
            100% { text-shadow: 0 0 25px #ffffff, 0 0 50px rgba(125, 249, 255, 0.9); }
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            background-color: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(100, 149, 237, 0.3);
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: rgba(30, 41, 59, 0.7);
            border-color: #7df9ff;
            box-shadow: 0 0 0 0.25rem rgba(125, 249, 255, 0.25);
            color: #ffffff;
        }

        .btn-login {
            background: linear-gradient(135deg, #6e45e2 0%, #88d3ce 100%);
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(110, 69, 226, 0.4);
            color: white;
            font-family: 'Orbitron', sans-serif;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #7d55f2 0%, #98e3de 100%);
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(110, 69, 226, 0.6);
        }

        .alert {
            border-radius: 8px;
            background-color: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            border-color: rgba(40, 167, 69, 0.3);
            color: #a8e9b8;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.2);
            border-color: rgba(220, 53, 69, 0.3);
            color: #ffb8c1;
        }

        .text-decoration-none {
            color: #7df9ff;
            transition: color 0.3s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .text-decoration-none:hover {
            color: #ffffff;
            text-shadow: 0 0 8px rgba(125, 249, 255, 0.7);
            text-decoration: none;
        }

        .input-group-text {
            background-color: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(100, 149, 237, 0.3);
            color: #7df9ff;
        }

        /* Hiệu ứng sao băng */
        .shooting-star {
            position: fixed;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 10px 2px white;
            z-index: -1;
            opacity: 0;
        }

        @keyframes shooting {
            0% { transform: translateX(0) translateY(0); opacity: 1; }
            100% { transform: translateX(1000px) translateY(500px); opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Background elements -->
    <div class="stars"></div>
    <div class="stars2"></div>
    <div class="stars3"></div>
    <div class="nebula nebula-1"></div>
    <div class="nebula nebula-2"></div>
    <div class="nebula nebula-3"></div>

    <!-- Shooting stars will be added by JS -->
    
    <div class="container">
        <div class="login-container">
            <h2 class="login-title">
                <i class="fas fa-planet-ringed planet-icon"></i>ĐĂNG NHẬP
            </h2>
            
            <!-- Hiển thị thông báo thành công -->
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            
            <!-- Hiển thị lỗi nếu có -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p class="mb-1"><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-satellite-dish"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-rocket me-2"></i>KHỞI HÀNH
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-3">
                <p class="mb-0">Chưa có tài khoản? <a href="{{ route('register') }}" class="text-decoration-none">Đăng ký ngay</a></p>
                <p class="mt-2"><a href="#" class="text-decoration-none"><i class="fas fa-key me-1"></i>Quên mật khẩu?</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Shooting stars animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create shooting stars
            function createShootingStar() {
                const star = document.createElement('div');
                star.className = 'shooting-star';
                star.style.left = Math.random() * 100 + 'vw';
                star.style.top = Math.random() * 100 + 'vh';
                star.style.animation = `shooting ${Math.random() * 3 + 2}s linear`;
                document.body.appendChild(star);
                
                // Remove star after animation
                setTimeout(() => {
                    star.remove();
                }, 5000);
            }
            
            // Create initial stars
            for (let i = 0; i < 5; i++) {
                setTimeout(createShootingStar, i * 1000);
            }
            
            // Keep creating stars
            setInterval(createShootingStar, 2000);
        });
    </script>
</body>
</html>