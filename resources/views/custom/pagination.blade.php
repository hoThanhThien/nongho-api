@if ($paginator->hasPages())
    <nav aria-label="{{ __('Pagination Navigation') }}">
        <ul class="pagination pagination-sm justify-content-center">
            {{-- First Page Link --}}
            @if ($paginator->currentPage() > 3)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="Đầu">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fas fa-angle-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Trước">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Sau">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link"><i class="fas fa-angle-right"></i></span>
                </li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Cuối">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
