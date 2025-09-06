@extends('layouts.app')

@section('title', 'Thống kê và Báo cáo')
@section('page-title', 'Thống kê và Báo cáo')

@section('content')
    @include('components.breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Thống kê', 'url' => ''],
        ]
    ])

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-0 shadow-sm bg-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase mb-0">Tổng Diện tích</h5>
                            <span class="h2 font-weight-bold mb-0">15,250.50 m²</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-white text-primary rounded-circle shadow">
                                <i class="fas fa-ruler-combined fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-0 shadow-sm bg-success text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase mb-0">Cây đang trồng</h5>
                            <span class="h2 font-weight-bold mb-0">45</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-white text-success rounded-circle shadow">
                                <i class="fas fa-seedling fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-0 shadow-sm bg-warning text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase mb-0">Sẵn sàng thu hoạch</h5>
                            <span class="h2 font-weight-bold mb-0">12</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-white text-warning rounded-circle shadow">
                                <i class="fas fa-cut fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-0 shadow-sm bg-info text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase mb-0">Hiệu suất TB</h5>
                            <span class="h2 font-weight-bold mb-0">87%</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-white text-info rounded-circle shadow">
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Crop Distribution Chart -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Phân bố loại cây trồng</h5>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-1"></i>Xuất
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="exportChart('cropChart', 'png')">PNG</a></li>
                            <li><a class="dropdown-item" href="#" onclick="exportChart('cropChart', 'pdf')">PDF</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="cropChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Area by Farm Chart -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Diện tích theo nông hộ</h5>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-1"></i>Xuất
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="exportChart('areaChart', 'png')">PNG</a></li>
                            <li><a class="dropdown-item" href="#" onclick="exportChart('areaChart', 'pdf')">PDF</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="areaChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Growth Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Tăng trưởng theo tháng</h5>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="timeRange" id="month3" autocomplete="off" checked>
                        <label class="btn btn-outline-primary btn-sm" for="month3">3 tháng</label>

                        <input type="radio" class="btn-check" name="timeRange" id="month6" autocomplete="off">
                        <label class="btn btn-outline-primary btn-sm" for="month6">6 tháng</label>

                        <input type="radio" class="btn-check" name="timeRange" id="month12" autocomplete="off">
                        <label class="btn btn-outline-primary btn-sm" for="month12">12 tháng</label>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="growthChart" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="row">
        <!-- Top Performing Farms -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-trophy text-warning me-2"></i>
                        Nông hộ hiệu quả nhất
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Xếp hạng</th>
                                    <th>Nông hộ</th>
                                    <th>Diện tích</th>
                                    <th>Hiệu suất</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="badge bg-warning">1</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle text-muted me-2"></i>
                                            <strong>Nông hộ A</strong>
                                        </div>
                                    </td>
                                    <td>2,500.00 m²</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" 
                                                 role="progressbar" 
                                                 style="width: 95%"
                                                 aria-valuenow="95" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                95%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge bg-warning">2</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle text-muted me-2"></i>
                                            <strong>Nông hộ B</strong>
                                        </div>
                                    </td>
                                    <td>1,800.50 m²</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" 
                                                 role="progressbar" 
                                                 style="width: 88%"
                                                 aria-valuenow="88" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                88%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge bg-warning">3</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle text-muted me-2"></i>
                                            <strong>Nông hộ C</strong>
                                        </div>
                                    </td>
                                    <td>3,200.25 m²</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" 
                                                 role="progressbar" 
                                                 style="width: 82%"
                                                 aria-valuenow="82" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                82%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock text-info me-2"></i>
                        Hoạt động gần đây
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Thêm thửa đất mới</h6>
                                <p class="text-muted mb-1">Đã thêm thửa đất "Ruộng lúa số 5" với diện tích 1500m²</p>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    2 giờ trước
                                </small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Cập nhật thông tin nông hộ</h6>
                                <p class="text-muted mb-1">Đã cập nhật thông tin liên hệ cho nông hộ Nguyễn Văn A</p>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    5 giờ trước
                                </small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Thu hoạch cây trồng</h6>
                                <p class="text-muted mb-1">Hoàn thành thu hoạch lúa tại thửa đất số 3</p>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    1 ngày trước
                                </small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-danger"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Xóa bản ghi</h6>
                                <p class="text-muted mb-1">Đã xóa cây trồng không còn sử dụng</p>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    2 ngày trước
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Sample data for charts
    const cropData = [
        { label: 'Lúa', value: 45 },
        { label: 'Ngô', value: 25 },
        { label: 'Rau muống', value: 15 },
        { label: 'Cà chua', value: 10 },
        { label: 'Khác', value: 5 }
    ];
    
    const areaData = [
        { label: 'Nông hộ A', value: 2500 },
        { label: 'Nông hộ B', value: 1800 },
        { label: 'Nông hộ C', value: 3200 },
        { label: 'Nông hộ D', value: 1500 },
        { label: 'Nông hộ E', value: 2100 }
    ];
    
    const growthData = [
        { month: 'T1/2025', thuadat: 5, nongho: 2, caytrong: 12 },
        { month: 'T2/2025', thuadat: 3, nongho: 4, caytrong: 8 },
        { month: 'T3/2025', thuadat: 7, nongho: 1, caytrong: 15 },
        { month: 'T4/2025', thuadat: 4, nongho: 3, caytrong: 10 },
        { month: 'T5/2025', thuadat: 6, nongho: 2, caytrong: 18 },
        { month: 'T6/2025', thuadat: 8, nongho: 5, caytrong: 22 },
        { month: 'T7/2025', thuadat: 2, nongho: 1, caytrong: 14 },
        { month: 'T8/2025', thuadat: 5, nongho: 3, caytrong: 16 }
    ];

    // Crop Distribution Pie Chart
    const cropCtx = document.getElementById('cropChart').getContext('2d');
    const cropChart = new Chart(cropCtx, {
        type: 'doughnut',
        data: {
            labels: cropData.map(item => item.label),
            datasets: [{
                data: cropData.map(item => item.value),
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                    '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' loại';
                        }
                    }
                }
            }
        }
    });

    // Area Bar Chart
    const areaCtx = document.getElementById('areaChart').getContext('2d');
    const areaChart = new Chart(areaCtx, {
        type: 'bar',
        data: {
            labels: areaData.map(item => item.label),
            datasets: [{
                label: 'Diện tích (m²)',
                data: areaData.map(item => item.value),
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' m²';
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' m²';
                        }
                    }
                }
            }
        }
    });

    // Growth Line Chart
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    const growthChart = new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: growthData.map(item => item.month),
            datasets: [{
                label: 'Thửa đất mới',
                data: growthData.map(item => item.thuadat),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1,
                fill: false
            }, {
                label: 'Nông hộ mới',
                data: growthData.map(item => item.nongho),
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.1,
                fill: false
            }, {
                label: 'Cây trồng mới',
                data: growthData.map(item => item.caytrong),
                borderColor: 'rgb(255, 205, 86)',
                backgroundColor: 'rgba(255, 205, 86, 0.2)',
                tension: 0.1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });

    // Export chart function
    function exportChart(chartId, format) {
        const canvas = document.getElementById(chartId);
        if (!canvas) {
            alert('Không tìm thấy biểu đồ để xuất!');
            return;
        }
        
        const url = canvas.toDataURL('image/png', 1.0);
        
        if (format === 'png') {
            const link = document.createElement('a');
            link.download = chartId + '_' + new Date().getTime() + '.png';
            link.href = url;
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show success notification
            if (window.nonghoApp) {
                window.nonghoApp.showNotification('Biểu đồ đã được xuất thành công!', 'success');
            }
        } else if (format === 'pdf') {
            // For PDF export, you would need jsPDF library
            alert('Chức năng xuất PDF sẽ được triển khai với thư viện jsPDF');
        }
    }

    // Time range filter for growth chart
    document.querySelectorAll('input[name="timeRange"]').forEach(radio => {
        radio.addEventListener('change', function() {
            let filteredData = [];
            const months = this.id.replace('month', '');
            
            if (months === '3') {
                filteredData = growthData.slice(-3);
            } else if (months === '6') {
                filteredData = growthData.slice(-6);
            } else {
                filteredData = growthData;
            }
            
            // Update chart data
            growthChart.data.labels = filteredData.map(item => item.month);
            growthChart.data.datasets[0].data = filteredData.map(item => item.thuadat);
            growthChart.data.datasets[1].data = filteredData.map(item => item.nongho);
            growthChart.data.datasets[2].data = filteredData.map(item => item.caytrong);
            growthChart.update();
            
            console.log('Đã thay đổi khoảng thời gian thành:', months, 'tháng');
        });
    });
    
    // Add some interactivity
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
                bar.style.transition = 'width 1s ease-in-out';
            }, 100);
        });
        
        // Add hover effects to chart containers
        const chartContainers = document.querySelectorAll('.card:has(canvas)');
        chartContainers.forEach(container => {
            container.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
                this.style.transition = 'all 0.3s ease';
            });
            
            container.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
    });
</script>

<style>
    .timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .timeline-marker {
        position: absolute;
        left: -1.75rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid #fff;
    }
    
    .timeline-content {
        padding-left: 1rem;
    }
</style>
@endsection
