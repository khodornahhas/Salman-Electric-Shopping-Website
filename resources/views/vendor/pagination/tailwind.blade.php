@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-center">
        <ul class="inline-flex items-center border rounded-md overflow-hidden">
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 text-gray-400 border-r cursor-default">&laquo;</li>
                <li class="px-3 py-2 text-gray-400 border-r cursor-default">&lsaquo;</li>
            @else
                <li>
                    <a href="{{ $paginator->url(1) }}" class="px-3 py-2 text-gray-700 hover:bg-gray-100 border-r">&laquo;</a>
                </li>
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-gray-700 hover:bg-gray-100 border-r">&lsaquo;</a>
                </li>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="px-3 py-2 text-gray-500 border-r">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-2 font-bold text-gray-900 bg-gray-200 border-r">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-3 py-2 text-gray-700 hover:bg-gray-100 border-r">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-gray-700 hover:bg-gray-100 border-r">&rsaquo;</a>
                </li>
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-3 py-2 text-gray-700 hover:bg-gray-100">&raquo;</a>
                </li>
            @else
                <li class="px-3 py-2 text-gray-400 border-r cursor-default">&rsaquo;</li>
                <li class="px-3 py-2 text-gray-400 cursor-default">&raquo;</li>
            @endif
        </ul>
    </nav>
@endif

