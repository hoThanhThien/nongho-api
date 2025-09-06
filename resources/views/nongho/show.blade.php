@extends('layouts.app')

@section('title', 'Chi tiết Nông hộ')
@section('page-title', 'Chi tiết Nông hộ: ' . $nongho->ten)

@section('page-actions')
    <a href="{{ route('nongho.edit', $nongho) }}" class="btn btn-warning">
        <i class="fas fa-edit me-2"></i>Chỉnh sửa
    </a>
    <a href="{{ route('thuadat.create') }}?nongho_id={{ $nongho->id }}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Thêm Thửa đất
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin Nông hộ</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Tên:</dt>
                        <dd class="col-sm-7">{{ $nongho->ten }}</dd>
                        
                        <dt class="col-sm-5">Địa chỉ:</dt>
                        <dd class="col-sm-7">{{ $nongho->dia_chi ?: 'Chưa cập nhật' }}</dd>
                        
                        <dt class="col-sm-5">Số điện thoại:</dt>
                        <dd class="col-sm-7">{{ $nongho->so_dien_thoai ?: 'Chưa cập nhật' }}</dd>
                        
                        <dt class="col-sm-5">Email:</dt>
                        <dd class="col-sm-7">{{ $nongho->email ?: 'Chưa cập nhật' }}</dd>
                        
                        <dt class="col-sm-5">Ngày tham gia:</dt>
                        <dd class="col-sm-7">{{ $nongho->created_at->format('d/m/Y H:i') }}</dd>
                        
                        <dt class="col-sm-5">Tổng thửa đất:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-primary">{{ $nongho->thuaDats->count() }} thửa</span>
                        </dd>
                        
                        <dt class="col-sm-5">Tổng diện tích:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-success">{{ number_format($nongho->thuaDats->sum('dien_tich'), 2) }} m²</span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Danh sách Thửa đất</h5>
                </div>
                <div class="card-body">
                    @if($nongho->thuaDats->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Thửa đất</th>
                                        <th>Diện tích</th>
                                        <th>Số cây trồng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nongho->thuaDats as $index => $thuadat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a href="{{ route('thuadat.show', $thuadat) }}" class="text-decoration-none">
                                                    <strong>{{ $thuadat->ten_thua }}</strong>
                                                </a>
                                            </td>
                                            <td>{{ number_format($thuadat->dien_tich, 2) }} m²</td>
                                            <td>
                                                <span class="badge bg-info">{{ $thuadat->cayTrongs->count() }} loại</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('thuadat.show', $thuadat) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('thuadat.edit', $thuadat) }}" class="btn btn-sm btn-outline-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-map fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Chưa có thửa đất nào</h5>
                            <p class="text-muted">Hãy thêm thửa đất đầu tiên cho nông hộ này!</p>
                            <a href="{{ route('thuadat.create') }}?nongho_id={{ $nongho->id }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Thêm Thửa đất
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
