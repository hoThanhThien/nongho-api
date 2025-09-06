<!-- Breadcrumb Component -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <i class="fas fa-home me-1"></i>Trang chủ
            </a>
        </li>
        @if(isset($breadcrumbs))
            @foreach($breadcrumbs as $breadcrumb)
                @if($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $breadcrumb['title'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb['url'] }}" class="text-decoration-none">
                            {{ $breadcrumb['title'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>
