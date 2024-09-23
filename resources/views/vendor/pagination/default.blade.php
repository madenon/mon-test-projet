
@if ($paginator->hasPages())
    <style>
        .pagination .active span {
            background-color: #007bff; /* Change this to your desired color */
            color: white;
            border-color: #007bff;
            border-radius: 4px;
            padding: 6px 12px;
        }
        .pagination li {
            display: inline;
            margin: 0 5px;
        }
        .pagination li a {
            color: #007bff; /* Change this to your desired color */
            text-decoration: none;
            border: 1px solid #dee2e6;
            padding: 6px 12px;
            border-radius: 4px;
        }
        .pagination li a:hover {
            background-color: #0056b3; /* Change this to your desired hover color */
            color: white;
        }
        .pagination .disabled span {
            color: #6c757d;
        }
    </style>
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">Précédent</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">Suivant</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
