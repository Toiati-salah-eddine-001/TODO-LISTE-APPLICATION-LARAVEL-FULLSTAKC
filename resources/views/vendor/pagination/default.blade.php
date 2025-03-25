@if ($paginator->hasPages())
    <div class="px-4 py-3 bg-gray-50 border-t flex items-center justify-between">
        {{-- عدد العناصر --}}
        <div class="text-sm text-gray-500">
            Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }} tasks
        </div>

        {{-- أزرار التنقل --}}
        <div class="flex items-center space-x-2">
            {{-- زر Previous --}}
            @if ($paginator->onFirstPage())
                <button class="px-3 py-1 border rounded-md text-sm disabled:opacity-50" disabled>Previous</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 border rounded-md text-sm hover:bg-gray-200">Previous</a>
            @endif

            {{-- أرقام الصفحات --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1 text-sm text-gray-500">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 border rounded-md text-sm bg-blue-500 text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 border rounded-md text-sm hover:bg-gray-200">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- زر Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 border rounded-md text-sm hover:bg-gray-200">Next</a>
            @else
                <button class="px-3 py-1 border rounded-md text-sm disabled:opacity-50" disabled>Next</button>
            @endif
        </div>
    </div>
@endif
