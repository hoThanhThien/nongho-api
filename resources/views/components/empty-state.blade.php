<!-- Empty State Component -->
<div class="empty-state">
    @if(isset($icon))
        <i class="fas fa-{{ $icon }} empty-icon d-block"></i>
    @else
        <i class="fas fa-inbox empty-icon d-block"></i>
    @endif
    
    <h5>{{ $title ?? 'Chưa có dữ liệu' }}</h5>
    <p>{{ $message ?? 'Hãy thêm mới để bắt đầu' }}</p>
    
    @if(isset($actionUrl) && isset($actionText))
        <a href="{{ $actionUrl }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>{{ $actionText }}
        </a>
    @endif
</div>
