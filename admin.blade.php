<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body>

    {{-- Sidebar --}}
    <!-- <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white" id="sidebar">
            <div class="sidebar-header p-3">
                <h4 class="text-center">Admin Panel</h4>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('chat-history.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-history mr-2"></i> Lịch sử tư vấn
                </a>
                {{-- Thêm các liên kết khác cho các phần quản lý nếu có --}}
            </div>
        </div> -->

        {{-- Page Content --}}
        <div id="page-content-wrapper" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="btn btn-primary" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="ml-auto">
                    <span class="text-dark">Chào mừng, Admin</span>
                </div>
            </nav>

            {{-- Main Content --}}
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

    <script>
        // Toggle Sidebar
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>
