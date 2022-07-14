@if ($paginator->hasPages())
        <ul class="pagination nav nav-tabs mt-4 overflow-x border-0">
            {{-- Previous Page Link
            @if ($paginator->onFirstPage())
                <li class="nav-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="nav-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> &lsaquo;</a>
                </li>
            @endif --}}

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="nav-item disabled" aria-disabled="true"><span class="nav-link">Trang {{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="nav-item" aria-current="page"><span class="nav-link active">Trang {{ $page }}</span></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ $url }}">Trang {{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link
            @if ($paginator->hasMorePages())
                <li class="nav-item">
                    <a class="nav-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="nav-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="nav-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif --}}
        </ul>
@endif
