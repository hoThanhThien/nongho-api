<!-- Status Badge Component -->
@php
    $statusConfig = [
        'active' => ['class' => 'success', 'icon' => 'check-circle', 'text' => 'Hoạt động'],
        'inactive' => ['class' => 'secondary', 'icon' => 'pause-circle', 'text' => 'Tạm dừng'],
        'pending' => ['class' => 'warning', 'icon' => 'clock', 'text' => 'Chờ xử lý'],
        'completed' => ['class' => 'info', 'icon' => 'check-circle-fill', 'text' => 'Hoàn thành'],
        'cancelled' => ['class' => 'danger', 'icon' => 'x-circle', 'text' => 'Hủy bỏ'],
        'đang_phát_triển' => ['class' => 'success', 'icon' => 'seedling', 'text' => 'Đang phát triển'],
        'thu_hoạch' => ['class' => 'warning', 'icon' => 'scissors', 'text' => 'Thu hoạch'],
        'hoàn_thành' => ['class' => 'info', 'icon' => 'check2-circle', 'text' => 'Hoàn thành'],
    ];
    
    $config = $statusConfig[$status] ?? ['class' => 'secondary', 'icon' => 'question-circle', 'text' => $status];
@endphp

<span class="badge bg-{{ $config['class'] }} d-inline-flex align-items-center">
    <span class="status-indicator status-{{ $status === 'active' || $status === 'đang_phát_triển' ? 'active' : ($status === 'pending' || $status === 'thu_hoạch' ? 'pending' : 'inactive') }}"></span>
    @if(isset($showIcon) && $showIcon)
        <i class="fas fa-{{ $config['icon'] }} me-1"></i>
    @endif
    {{ $config['text'] }}
</span>
