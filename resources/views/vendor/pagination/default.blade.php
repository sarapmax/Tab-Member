@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}">หน้าแรก</a>
        </li>
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="{{ $page == $paginator->currentPage() ? ' active' : ''  }}" ><a href="{{ $url }}">{{ $page }}</a></li>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
        <li class="{{ !$paginator->hasMorePages() ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->lastPage()) }}">หน้าสุดท้าย</a>
        </li>
    </ul>
@endif
