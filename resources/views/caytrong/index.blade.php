@extends('layouts.app')

@section('title', 'Quản lý Cây trồng')
@section('page-title', 'Quản lý Cây trồng')

@section('page-actions')
    <a href="{{ route('caytrong.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Thêm Cây trồng mới
    </a>
@endsection

@section('content')
    @include('components.breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Cây trồng', 'url' => route('caytrong.index')],
        ]
    ])

    @include('components.search-filter', [
        'placeholder' => 'Tìm kiếm cây trồng...',
        'showFilters' => true,
        'exportButton' => true
    ])

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th width="15%">Tên cây trồng</th>
                            <th width="10%">Loại cây</th>
                            <th width="15%">Giống</th>
                            <th width="15%">Thửa đất</th>
                            <th width="10%">Diện tích (m²)</th>
                            <th width="10%">Ngày trồng</th>
                            <th width="10%">Trạng thái</th>
                            <th width="10%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cayTrongs as $index => $cayTrong)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-seedling text-success me-2"></i>
                                    <strong>{{ $cayTrong->ten_cay }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $cayTrong->loai_cay }}</span>
                            </td>
                            <td>
                                @if($cayTrong->giong)
                                    <span class="text-primary">
                                        <i class="fas fa-dna me-1"></i>{{ $cayTrong->giong }}
                                    </span>
                                @else
                                    <span class="text-muted">Không xác định</span>
                                @endif
                            </td>
                            <td>
                                @if($cayTrong->thuaDat)
                                    <a href="{{ route('thuadat.show', $cayTrong->thuaDat->id) }}" class="text-decoration-none">
                                        {{ $cayTrong->thuaDat->ten_thua_dat }}
                                    </a>
                                @else
                                    <span class="text-muted">Không xác định</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ number_format($cayTrong->dien_tich, 2) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $cayTrong->ngay_trong ? $cayTrong->ngay_trong->format('d/m/Y') : 'N/A' }}
                                </small>
                            </td>
                            <td>
                                @if($cayTrong->trang_thai === 'đang_phát_triển')
                                    <span class="badge bg-success">
                                        <span class="status-indicator status-active"></span>
                                        Đang phát triển
                                    </span>
                                @elseif($cayTrong->trang_thai === 'thu_hoạch')
                                    <span class="badge bg-warning">
                                        <span class="status-indicator status-pending"></span>
                                        Thu hoạch
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <span class="status-indicator status-inactive"></span>
                                        Không xác định
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('caytrong.show', $cayTrong->id) }}" 
                                       class="btn btn-outline-info btn-sm" 
                                       title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('caytrong.edit', $cayTrong->id) }}" 
                                       class="btn btn-outline-warning btn-sm"
                                       title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" 
                                          action="{{ route('caytrong.destroy', $cayTrong->id) }}" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm delete-btn"
                                                title="Xóa"
                                                data-message="Bạn có chắc chắn muốn xóa cây trồng {{ $cayTrong->ten_cay }}?">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                @include('components.empty-state', [
                                    'icon' => 'seedling',
                                    'title' => 'Thửa đất này chưa có cây trồng nào',
                                    'message' => 'Hãy thêm cây trồng đầu tiên cho thửa đất này!',
                                    'actionUrl' => route('caytrong.create'),
                                    'actionText' => 'Thêm Cây trồng'
                                ])
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(method_exists($cayTrongs, 'links'))
        <div class="card-footer">
            {{ $cayTrongs->links('components.pagination') }}
        </div>
        @endif
    </div>

    @include('components.confirm-modal')
    @include('components.loading-spinner')
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any additional JavaScript functionality here
        console.log('Cây trồng management page loaded');
    });
</script>
@endsection
