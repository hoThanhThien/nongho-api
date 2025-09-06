<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản Lý Nông Hộ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #f8f9fa;
        }
        .sidebar .nav-link {
            color: #333;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }
        main {
            margin-left: 240px;
            position: relative;
            z-index: 1;
        }
        .card-stats {
            border-left: 4px solid #0d6efd;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        /* Icon styling */
        .icon-shape {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Button improvements */
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        /* Table improvements */
        .table {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        
        /* Badge improvements */
        .badge {
            padding: 0.5em 0.8em;
            border-radius: 0.5rem;
            font-size: 0.875rem;
        }
        
        /* Alert improvements */
        .alert {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        /* Bootstrap Modal Styling */
        .modal {
            z-index: 1055;
        }
        
        .modal-backdrop {
            z-index: 1050;
        }
        
        .modal-dialog {
            margin: 1.75rem auto;
            max-width: 500px;
            position: relative;
            z-index: 1;
        }
        
        .modal-dialog.modal-lg {
            max-width: 800px;
        }
        
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 3.5rem);
        }
        
        .modal-content {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-height: 90vh;
            overflow: hidden;
            position: relative;
        }
        
        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.75rem 0.75rem 0 0;
            flex-shrink: 0;
        }
        
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        
        .modal-body {
            padding: 1.5rem;
            overflow-y: auto;
            max-height: calc(90vh - 200px);
        }
        
        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            background-color: #f8f9fa;
            border-radius: 0 0 0.75rem 0.75rem;
            flex-shrink: 0;
        }
        
        /* Modal animations */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }
        
        .modal.show .modal-dialog {
            transform: none;
        }
        
        /* Dropdown fixes */
        .dropdown-menu {
            z-index: 1020;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border-radius: 0.75rem;
            padding: 0.5rem 0;
        }
        .dropdown-item {
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }
        
        /* Table responsive fixes */
        .table-responsive {
            position: relative;
            z-index: 1;
            border-radius: 0.75rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        /* Action buttons fixes */
        .btn-group {
            z-index: 10;
        }
        
        /* Specific fixes for overlapping issues */
        .table td {
            position: relative;
        }
        
        .table .dropdown {
            position: static;
        }
        
        .table .dropdown-menu {
            position: absolute;
            right: 0;
            left: auto;
            min-width: 160px;
        }
        
        /* Loading spinner */
        .loading-spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }
        
        /* Breadcrumb styling */
        .breadcrumb {
            background: transparent;
            padding: 0;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            color: #6c757d;
        }
        
        /* Form improvements */
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        /* Form validation styling */
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .form-control.is-valid {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }
        
        .form-select.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .form-select.is-valid {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }
        
        /* Better form validation styling */
        .is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        
        /* Let Bootstrap handle modal z-index naturally */
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        
        /* Search box styling */
        .search-box {
            position: relative;
        }
        .search-box .form-control {
            padding-left: 2.5rem;
        }
        .search-box .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        /* Status indicators */
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
        }
        .status-active {
            background-color: #28a745;
        }
        .status-inactive {
            background-color: #dc3545;
        }
        .status-pending {
            background-color: #ffc107;
        }
        
        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }
        .empty-state .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        .empty-state h5 {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .empty-state p {
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }
        
        /* Card hover effects */
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        /* Animated loading */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        .loading-pulse {
            animation: pulse 1.5s infinite;
        }
        
        /* Success state animations */
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% { transform: translate3d(0,0,0); }
            40%, 43% { transform: translate3d(0,-30px,0); }
            70% { transform: translate3d(0,-15px,0); }
            90% { transform: translate3d(0,-4px,0); }
        }
        .animate-bounce {
            animation: bounce 1s;
        }
        
        /* Custom Pagination Styles */
        .pagination {
            margin-bottom: 0;
        }
        .page-link {
            color: #0d6efd;
            border-color: #dee2e6;
            padding: 0.5rem 0.75rem;
            margin: 0 2px;
            border-radius: 0.375rem !important;
            transition: all 0.3s ease;
        }
        .page-link:hover {
            color: #0a58ca;
            background-color: #f8f9fa;
            border-color: #0d6efd;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }
        .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            border-color: #dee2e6;
        }
        .dataTables_info {
            padding: 0.5rem 0;
        }
        /* Responsive pagination */
        @media (max-width: 768px) {
            .pagination {
                justify-content: center !important;
            }
            .dataTables_info {
                text-align: center;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
        <div class="position-sticky pt-3">
            <h5 class="px-3 text-muted">QUẢN LÝ NÔNG HỘ</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Tổng quan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('thuadat.*') ? 'active' : '' }}" href="{{ route('thuadat.index') }}">
                        <i class="fas fa-map me-2"></i>
                        Quản lý Thửa đất
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('nongho.*') ? 'active' : '' }}" href="{{ route('nongho.index') }}">
                        <i class="fas fa-users me-2"></i>
                        Quản lý Nông hộ
                    </a>
                </li>
                
                
               
                
                <li class="nav-item mt-3">
                    <h6 class="px-3 text-muted text-uppercase small">Cài đặt</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal">
                        <i class="fas fa-cog me-2"></i>
                        Cài đặt hệ thống
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">@yield('page-title', 'Dashboard')</h1>
            @hasSection('page-actions')
                <div class="btn-toolbar mb-2 mb-md-0">
                    @yield('page-actions')
                </div>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Settings Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingsModalLabel">
                        <i class="fas fa-cog me-2"></i>Cài đặt hệ thống
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="defaultPageSize" class="form-label">Số bản ghi mỗi trang</label>
                        <select class="form-select" id="defaultPageSize">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dateFormat" class="form-label">Định dạng ngày tháng</label>
                        <select class="form-select" id="dateFormat">
                            <option value="dd/mm/yyyy" selected>dd/mm/yyyy</option>
                            <option value="mm/dd/yyyy">mm/dd/yyyy</option>
                            <option value="yyyy-mm-dd">yyyy-mm-dd</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="enableNotifications" checked>
                            <label class="form-check-label" for="enableNotifications">
                                Bật thông báo
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="autoSave">
                            <label class="form-check-label" for="autoSave">
                                Tự động lưu
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="saveSettings()">Lưu cài đặt</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/nongho-app.js') }}"></script>
    
    <script>
        // Global JavaScript functions
        function generateReport(type) {
            // Show loading
            const loadingSpinner = document.getElementById('loadingSpinner');
            if (loadingSpinner) {
                loadingSpinner.style.display = 'block';
            }
            
            // Simulate report generation
            setTimeout(() => {
                alert(`Đang tạo báo cáo ${type}...`);
                if (loadingSpinner) {
                    loadingSpinner.style.display = 'none';
                }
            }, 1000);
        }
        
        function saveSettings() {
            const pageSize = document.getElementById('defaultPageSize').value;
            const dateFormat = document.getElementById('dateFormat').value;
            const notifications = document.getElementById('enableNotifications').checked;
            const autoSave = document.getElementById('autoSave').checked;
            
            // Save to localStorage
            localStorage.setItem('settings', JSON.stringify({
                pageSize: pageSize,
                dateFormat: dateFormat,
                notifications: notifications,
                autoSave: autoSave
            }));
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('settingsModal'));
            modal.hide();
            
            // Show success message
            showNotification('Cài đặt đã được lưu thành công!', 'success');
        }
        
        function loadSettings() {
            const settings = localStorage.getItem('settings');
            if (settings) {
                const parsedSettings = JSON.parse(settings);
                document.getElementById('defaultPageSize').value = parsedSettings.pageSize || '25';
                document.getElementById('dateFormat').value = parsedSettings.dateFormat || 'dd/mm/yyyy';
                document.getElementById('enableNotifications').checked = parsedSettings.notifications !== false;
                document.getElementById('autoSave').checked = parsedSettings.autoSave || false;
            }
        }
        
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }
        
        // Load settings on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadSettings();
            
            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
