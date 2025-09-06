@extends('layouts.app')

@section('title', 'Quản lý Nông hộ')
@section('page-title', 'Quản lý Nông hộ')

@section('page-actions')
    <a href="{{ route('nongho.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Thêm Nông hộ mới
    </a>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <form method="GET" action="{{ route('nongho.index') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên nông hộ..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Tìm kiếm
                    </button>
                    <a href="{{ route('nongho.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Xóa bộ lọc
                    </a>
                </div>
            </form>
        </div>
        
        <div class="card-body">
            @if($nongHos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên Nông hộ</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày tham gia</th>
                                <th>Số thửa đất</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nongHos as $index => $nongho)
                                <tr>
                                    <td>{{ $nongHos->firstItem() + $index }}</td>
                                    <td>
                                        <a href="{{ route('nongho.show', $nongho) }}" class="text-decoration-none">
                                            <strong>{{ $nongho->ten }}</strong>
                                        </a>
                                    </td>
                                    <td>
                                        @if($nongho->dia_chi)
                                            <i class="fas fa-map-marker-alt me-1 text-muted"></i>
                                            {{ Str::limit($nongho->dia_chi, 30) }}
                                        @else
                                            <span class="text-muted">Chưa cập nhật</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($nongho->so_dien_thoai)
                                            <i class="fas fa-phone me-1 text-muted"></i>
                                            {{ $nongho->so_dien_thoai }}
                                        @else
                                            <span class="text-muted">Chưa cập nhật</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($nongho->email)
                                            <i class="fas fa-envelope me-1 text-muted"></i>
                                            {{ $nongho->email }}
                                        @else
                                            <span class="text-muted">Chưa cập nhật</span>
                                        @endif
                                    </td>
                                    <td>{{ $nongho->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $nongho->thuaDats->count() }} thửa</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('nongho.show', $nongho) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('nongho.edit', $nongho) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('nongho.destroy', $nongho) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa nông hộ này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="row align-items-center mt-3">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                        <div class="dataTables_info">
                            <small class="text-muted">
                                Hiển thị <strong>{{ $nongHos->firstItem() ?? 0 }}</strong> đến <strong>{{ $nongHos->lastItem() ?? 0 }}</strong> 
                                trong tổng số <strong>{{ $nongHos->total() }}</strong> kết quả
                                @if(request('search'))
                                    <br><span class="badge bg-primary mt-1">
                                        <i class="fas fa-search me-1"></i>Tìm kiếm: "{{ request('search') }}"
                                    </span>
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-center justify-content-md-end">
                            @if ($nongHos->hasPages())
                                <nav aria-label="Phân trang nông hộ">
                                    {{ $nongHos->withQueryString()->links('custom.pagination') }}
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Không có nông hộ nào</h5>
                    <p class="text-muted">Hãy thêm nông hộ đầu tiên của bạn!</p>
                    <a href="{{ route('nongho.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Thêm Nông hộ mới
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading effect to pagination links
    document.querySelectorAll('.pagination .page-link').forEach(function(link) {
        link.addEventListener('click', function() {
            if (!this.parentElement.classList.contains('active') && !this.parentElement.classList.contains('disabled')) {
                // Show loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.style.pointerEvents = 'none';
            }
        });
    });

    // Add loading effect to search form
    document.querySelector('form').addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tìm...';
        submitBtn.disabled = true;
        
        // Re-enable after 3 seconds in case of slow response
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });

    // Auto-hide success messages
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }, 5000);
    });

    // Enhanced search functionality with debouncing
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        let timeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                // You can add auto-search here if needed
                // this.form.submit();
            }, 500);
        });
    }
});
</script>
@endsection
