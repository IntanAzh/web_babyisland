@if ($paginator->hasPages())
    <nav class="flex justify-center space-x-4 px-6 py-3">
        <ul class="flex space-x-4">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><span class="text-gray-400">Prev</span></li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="text-gray-600 hover:text-gray-900">Prev</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="text-gray-600">{{ $element }}</span></li>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="text-blue-600 font-semibold">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="text-gray-600 hover:text-gray-900">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="text-gray-600 hover:text-gray-900">Next</a>
                </li>
            @else
                <li><span class="text-gray-400">Next</span></li>
            @endif

        </ul>
    </nav>
@endif
