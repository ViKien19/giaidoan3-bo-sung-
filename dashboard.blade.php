<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản Trị Hệ Thống Tarot</title>
    
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    {{-- Chart.js --}}
    <link href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6a1b9a;
            --secondary: #9c27b0;
            --accent: #ce93d8;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #f72585;
            --sidebar-width: 250px;
            --navbar-height: 60px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark);
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            height: var(--navbar-height);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0 2rem;
        }

        .navbar-brand {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            color: white !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
            font-size: 1.3rem;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            color: var(--dark);
            position: fixed;
            top: var(--navbar-height);
            height: calc(100vh - var(--navbar-height));
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 0.5rem;
        }

        .sidebar-header h2 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-menu {
            list-style: none;
            padding: 0 0.5rem;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            color: var(--dark);
            text-decoration: none;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            border-radius: 8px;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(106, 27, 154, 0.1);
            color: var(--primary);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            margin-top: var(--navbar-height);
            transition: all 0.3s;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .header h1 {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            color: var(--dark);
            font-size: 1.75rem;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-radius: 10px 10px 0 0 !important;
        }

        /* Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 4px solid var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card.primary {
            border-top-color: var(--primary);
        }

        .stat-card.success {
            border-top-color: var(--success);
        }

        .stat-card.warning {
            border-top-color: var(--warning);
        }

        .stat-card.accent {
            border-top-color: var(--accent);
        }

        .stat-title {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-change {
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-change.positive {
            color: #28a745;
        }

        .stat-change.negative {
            color: #dc3545;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #5d33a8;
            border-color: #5d33a8;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            padding: 1rem 1.25rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        th {
            background-color: #f8f9fa;
            font-weight: 500;
        }

        tr:hover {
            background-color: rgba(0, 0, 0, 0.01);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .form-control:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(106, 27, 154, 0.25);
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .tab {
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-weight: 500;
        }

        .tab.active {
            border-bottom-color: var(--primary);
            color: var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .navbar-toggler {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('tarot-cards.index') }}">
                <i class="fas fa-crystal-ball"></i>
                <span>Tarot Admin</span>
            </a>
            <div class="d-flex align-items-center">
                <div class="user-info">
                    <div class="user-avatar">AD</div>
                    <span class="text-white">Quản Trị Viên</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar collapse d-lg-block" id="sidebarCollapse">
        <div class="sidebar-header">
            <h2><i class="fas fa-bars"></i> Menu</h2>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link active" data-tab="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Bảng Điều Khiển</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tarot-cards.index') }}" class="nav-link" data-tab="tarot-management">
                    <i class="fa-tasks"></i>
                    <span>Quản Lý Bài Tarot</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('chat-history.index') }}" class="nav-link" data-tab="chatbot-management">
                    <i class="fas fa-robot"></i>
                    <span>Quản lý lịch sử tư vấn </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-tab="user-management">
                    <i class="fas fa-users"></i>
                    <span>Quản Lý Người Dùng</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-tab="reports">
                    <i class="fas fa-chart-bar"></i>
                    <span>Thống Kê & Báo Cáo</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Đăng Xuất</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Bảng Điều Khiển Quản Trị</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bảng điều khiển</li>
                </ol>
            </nav>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tab nội dung -->
        <div class="tabs">
            <div class="tab active" data-tab="dashboard">Tổng Quan</div>
            <div class="tab" data-tab="tarot-management">Bài Tarot</div>
            <div class="tab" data-tab="chatbot-management">Chatbot</div>
            <div class="tab" data-tab="user-management">Người Dùng</div>
            <div class="tab" data-tab="reports">Thống Kê</div>
        </div>

        <!-- Tab: Bảng điều khiển -->
        <div id="dashboard" class="tab-content active">
            <div class="stats-container">
                <div class="stat-card primary">
                    <div class="stat-title">Tổng Lá Bài Tarot</div>
                    <div class="stat-value" id="total-cards">0</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>Loading...</span>
                    </div>
                </div>
                <div class="stat-card success">
                    <div class="stat-title">Lượt Tư Vấn Hôm Nay</div>
                    <div class="stat-value">1,248</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>8% so với hôm qua</span>
                    </div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-title">Người Dùng Mới</div>
                    <div class="stat-value">24</div>
                    <div class="stat-change negative">
                        <i class="fas fa-arrow-down"></i>
                        <span>3% so với tuần trước</span>
                    </div>
                </div>
                <div class="stat-card accent">
                    <div class="stat-title">Câu Hỏi Chưa Trả Lời</div>
                    <div class="stat-value">12</div>
                    <div class="stat-change positive">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Cần xử lý</span>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Thống kê truy cập</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="trafficChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Bài Tarot phổ biến</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    The Fool
                                    <span class="badge bg-primary rounded-pill">1,245</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    The Magician
                                    <span class="badge bg-primary rounded-pill">987</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    The High Priestess
                                    <span class="badge bg-primary rounded-pill">876</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    The Empress
                                    <span class="badge bg-primary rounded-pill">765</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    The Emperor
                                    <span class="badge bg-primary rounded-pill">654</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Quản lý người dùng -->
        <div id="user-management" class="tab-content">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh Sách Người Dùng</h5>
                    <button class="btn btn-primary" id="add-user">
                        <i class="fas fa-plus me-1"></i> Thêm Người Dùng
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Người Dùng</th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>Vai Trò</th>
                                    <th>Ngày Tạo</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody id="users-table">
                                <!-- Sẽ được cập nhật bằng JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Form thêm/sửa người dùng -->
            <div class="card mt-4" id="user-form" style="display: none;">
                <div class="card-header">
                    <h5 class="mb-0" id="user-form-title">Thêm Người Dùng</h5>
                </div>
                <div class="card-body">
                    <form id="user-form-submit">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tên Người Dùng</label>
                                    <input type="text" name="username" class="form-control" placeholder="Nhập tên người dùng" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Họ Tên</label>
                                    <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Vai Trò</label>
                                    <select name="role_id" class="form-select" required>
                                        <option value="">Chọn vai trò</option>
                                        <option value="1">Quản trị viên</option>
                                        <option value="2">Biên tập viên</option>
                                        <option value="3">Người dùng thường</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mật Khẩu</label>
                                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Xác Nhận Mật Khẩu</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-secondary" id="cancel-user-form">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu Người Dùng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Content section for other tabs will be here -->
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    
    <script>
    // Biến toàn cục
    let editingUserId = null;
    const USER_API_BASE_URL = '/users'; // Sử dụng /users thay vì /api/users

    // Load danh sách người dùng từ API
    async function loadUsers() {
        try {
            const response = await fetch(USER_API_BASE_URL, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            const tbody = document.getElementById('users-table');
            tbody.innerHTML = '';

            data.data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.username}</td>
                    <td>${user.fullname}</td>
                    <td>${user.email}</td>
                    <td>${getRoleName(user.role_id)}</td>
                    <td>${new Date(user.created_at).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="editUser(${user.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteUser(${user.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        } catch (error) {
            console.error('Error loading users:', error);
            alert('Có lỗi khi tải danh sách người dùng: ' + error.message);
        }
    }

    function getRoleName(roleId) {
        switch(roleId) {
            case 1: return 'Quản trị viên';
            case 2: return 'Biên tập viên';
            case 3: return 'Người dùng';
            default: return 'Không xác định';
        }
    }

    function showUserForm(user = null) {
        const form = document.getElementById('user-form');
        const formTitle = document.getElementById('user-form-title');
        const formElement = document.getElementById('user-form-submit');
        
        if (user) {
            formTitle.textContent = 'Sửa Người Dùng';
            editingUserId = user.id;
            formElement.querySelector('input[name="username"]').value = user.username;
            formElement.querySelector('input[name="fullname"]').value = user.fullname;
            formElement.querySelector('input[name="email"]').value = user.email;
            formElement.querySelector('select[name="role_id"]').value = user.role_id;
            formElement.querySelector('input[name="password"]').required = false;
            formElement.querySelector('input[name="password_confirmation"]').required = false;
        } else {
            formTitle.textContent = 'Thêm Người Dùng';
            editingUserId = null;
            formElement.reset();
            formElement.querySelector('input[name="password"]').required = true;
            formElement.querySelector('input[name="password_confirmation"]').required = true;
        }
        
        form.style.display = 'block';
        window.scrollTo({ top: form.offsetTop, behavior: 'smooth' });
    }

    document.getElementById('user-form-submit').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const jsonData = Object.fromEntries(formData.entries());
        
        try {
            let response;
            if (editingUserId) {
                response = await fetch(`${USER_API_BASE_URL}/${editingUserId}`, {
                    method: 'PUT',
                    body: JSON.stringify(jsonData),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
            } else {
                response = await fetch(USER_API_BASE_URL, {
                    method: 'POST',
                    body: JSON.stringify(jsonData),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
            }
            
            const result = await response.json();
            
            if (response.ok) {
                alert(editingUserId ? 'Cập nhật người dùng thành công!' : 'Thêm người dùng thành công!');
                document.getElementById('user-form').style.display = 'none';
                loadUsers();
            } else {
                throw new Error(result.message || 'Có lỗi xảy ra');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Lỗi: ' + error.message);
        }
    });

    async function deleteUser(userId) {
        if (!confirm('Bạn có chắc chắn muốn xóa người dùng này?')) return;
        
        try {
            const response = await fetch(`${USER_API_BASE_URL}/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const result = await response.json();
            
            if (response.ok) {
                alert('Xóa người dùng thành công!');
                loadUsers();
            } else {
                throw new Error(result.message || 'Có lỗi khi xóa người dùng');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Lỗi: ' + error.message);
        }
    }

    async function editUser(userId) {
        try {
            const response = await fetch(`${USER_API_BASE_URL}/${userId}`, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            const result = await response.json();
            
            if (response.ok) {
                showUserForm(result.data);
            } else {
                throw new Error(result.message || 'Có lỗi khi tải thông tin người dùng');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Lỗi: ' + error.message);
        }
    }

    // Initialize traffic chart
    function initTrafficChart() {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        const trafficChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
                datasets: [{
                    label: 'Lượt truy cập',
                    data: [1200, 1900, 1700, 2100, 2400, 2800],
                    backgroundColor: 'rgba(106, 27, 154, 0.1)',
                    borderColor: 'rgba(106, 27, 154, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize components
        loadUsers();
        initTrafficChart();
        
        // Event listeners
        document.getElementById('add-user').addEventListener('click', function() {
            showUserForm();
        });
        
        document.getElementById('cancel-user-form').addEventListener('click', function() {
            document.getElementById('user-form').style.display = 'none';
        });
        
        // Tab switching
        document.querySelectorAll('.nav-link, .tab').forEach(item => {
            item.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Update active states
                document.querySelectorAll('.nav-link, .tab, .tab-content').forEach(el => {
                    el.classList.remove('active');
                });
                
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
                
                // Update URL hash
                window.location.hash = tabId;
            });
        });
        
        // Check URL hash on load
        if (window.location.hash) {
            const tabId = window.location.hash.substring(1);
            const tabElement = document.querySelector(`.nav-link[data-tab="${tabId}"], .tab[data-tab="${tabId}"]`);
            if (tabElement) {
                tabElement.click();
            }
        }
        
        // Responsive sidebar toggle
        const sidebarCollapse = document.getElementById('sidebarCollapse');
        const sidebar = document.querySelector('.sidebar');
        
        if (sidebarCollapse) {
            sidebarCollapse.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
        
        // Update total cards count (simulated)
        setTimeout(() => {
            document.getElementById('total-cards').textContent = '78';
            document.querySelector('.stat-change.positive span').textContent = 'Đã tải xong';
        }, 1000);
    });
</script>
</body>
</html>