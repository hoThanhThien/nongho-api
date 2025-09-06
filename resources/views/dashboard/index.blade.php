@extends('layouts.app')

@section('title', 'Tổng quan - Quản Lý Nông Hộ')
@section('page-title', 'Tổng quan')

@section('page-actions')
    <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-plus me-2"></i>Thêm mới
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('thuadat.create') }}">
                <i class="fas fa-map me-2"></i>Thửa đất mới
            </a></li>
            <li><a class="dropdown-item" href="{{ route('nongho.create') }}">
                <i class="fas fa-user-plus me-2"></i>Nông hộ mới
            </a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-stats border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Tổng số Thửa đất</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $totalThuaDat }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                <i class="fas fa-map fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-stats border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Tổng số Nông hộ</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $totalNongHo }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card card-stats border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Loại Cây trồng</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $totalCayTrong }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                <i class="fas fa-seedling fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">Biểu đồ Diện tích theo Nông hộ</h5>
                </div>
                <div class="card-body">
                    <canvas id="areaChart" width="400" height="200" data-chart='@json($thuaDatByNongHo)'></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">Hành động nhanh</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('thuadat.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-map me-2"></i>Thêm Thửa đất mới
                        </a>
                        <a href="{{ route('nongho.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-user-plus me-2"></i>Thêm Nông hộ mới
                        </a>
                        <a href="{{ route('thuadat.index') }}" class="btn btn-outline-info">
                            <i class="fas fa-list me-2"></i>Xem tất cả Thửa đất
                        </a>
                        <a href="{{ route('nongho.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-users me-2"></i>Xem tất cả Nông hộ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="application/javascript">
    // Dữ liệu biểu đồ
    var chartData = JSON.parse(document.getElementById('areaChart').getAttribute('data-chart'));
    var labels = chartData.map(function(item) { return item.nong_ho ? item.nong_ho.ten : 'Không xác định'; });
    var data = chartData.map(function(item) { return parseFloat(item.total_area); });

    // Tạo biểu đồ
    var ctx = document.getElementById('areaChart').getContext('2d');
    var areaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Diện tích (m²)',
                data: data,
                backgroundColor: 'rgba(13, 110, 253, 0.8)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Diện tích (m²)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nông hộ'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection
