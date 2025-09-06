@extends('layouts.app')

@section('title', 'Quản lý Thửa đất')
@section('page-title', 'Quản lý Thửa đất')

@section('page-actions')
    <a href="{{ route('thuadat.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Thêm Thửa đất mới
    </a>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <form method="GET" action="{{ route('thuadat.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên thửa đất..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="nongho_filter">
                        <option value="">Tất cả nông hộ</option>
                        @foreach($nongHos as $nongho)
                            <option value="{{ $nongho->id }}" {{ request('nongho_filter') == $nongho->id ? 'selected' : '' }}>
                                {{ $nongho->ten }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Tìm kiếm
                    </button>
                    <a href="{{ route('thuadat.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Xóa bộ lọc
                    </a>
                </div>
            </form>
        </div>
        
        <div class="card-body">
            @if($thuaDats->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên Thửa đất</th>
                                <th>Diện tích</th>
                                <th>Nông hộ sở hữu</th>
                                <th>Số cây trồng</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($thuaDats as $index => $thuadat)
                                <tr>
                                    <td>{{ $thuaDats->firstItem() + $index }}</td>
                                    <td>
                                        <a href="{{ route('thuadat.show', $thuadat) }}" class="text-decoration-none">
                                            <strong>{{ $thuadat->ten_thua }}</strong>
                                        </a>
                                    </td>
                                    <td>{{ number_format($thuadat->dien_tich, 2) }} m²</td>
                                    <td>
                                        <a href="{{ route('nongho.show', $thuadat->nongHo) }}" class="text-decoration-none">
                                            {{ $thuadat->nongHo->ten }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $thuadat->cayTrongs->count() }} loại</span>
                                    </td>
                                    <td>{{ $thuadat->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('thuadat.show', $thuadat) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('thuadat.edit', $thuadat) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('thuadat.destroy', $thuadat) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thửa đất này?')">
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
                
                <!-- Pagination Info -->
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <div class="pagination-info">
                            <small class="text-muted">
                                Hiển thị {{ $thuaDats->firstItem() }} đến {{ $thuaDats->lastItem() }} 
                                trong tổng số {{ $thuaDats->total() }} thửa đất
                            </small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-end">
                            {{ $thuaDats->appends(request()->query())->links('custom.pagination') }}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-map fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Không có thửa đất nào</h5>
                    <p class="text-muted">Hãy thêm thửa đất đầu tiên của bạn!</p>
                    <a href="{{ route('thuadat.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Thêm Thửa đất mới
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
