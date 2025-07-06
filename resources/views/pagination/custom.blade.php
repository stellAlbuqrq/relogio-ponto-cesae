

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center mt-6">
        <div class="flex items-center space-x-2">

            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-100 rounded-full cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="flex items-center justify-center w-10 h-10 text-[#6A239B] bg-white border border-gray-300 rounded-full hover:bg-[#6A239B] hover:text-white transition-colors duration-200 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $start = max(1, $currentPage - 1);
                $end = min($lastPage, $currentPage + 1);

                // Ajustar para sempre mostrar 3 páginas quando possível
                if ($end - $start < 2) {
                    if ($start == 1) {
                        $end = min($lastPage, 3);
                    } else {
                        $start = max(1, $lastPage - 2);
                    }
                }
            @endphp

            @if ($start > 1)
                <a href="{{ $paginator->url(1) }}"
                   class="flex items-center justify-center w-10 h-10 text-[#6A239B] bg-white border border-gray-300 rounded-full hover:bg-[#6A239B] hover:text-white transition-colors duration-200 shadow-sm">
                    1
                </a>
                @if ($start > 2)
                    <span class="flex items-center justify-center w-10 h-10 text-gray-500 bg-white border border-gray-300 rounded-full">
                        ...
                    </span>
                @endif
            @endif


            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $currentPage)
                    <span class="flex items-center justify-center w-10 h-10 text-white bg-[#6A239B] border border-[#6A239B] rounded-full font-medium shadow-md">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}"
                       class="flex items-center justify-center w-10 h-10 text-[#6A239B] bg-white border border-gray-300 rounded-full hover:bg-[#6A239B] hover:text-white transition-colors duration-200 shadow-sm">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            @if ($end < $lastPage)
                @if ($end < $lastPage - 1)
                    <span class="flex items-center justify-center w-10 h-10 text-gray-500 bg-white border border-gray-300 rounded-full">
                        ...
                    </span>
                @endif
                <a href="{{ $paginator->url($lastPage) }}"
                   class="flex items-center justify-center w-10 h-10 text-[#6A239B] bg-white border border-gray-300 rounded-full hover:bg-[#6A239B] hover:text-white transition-colors duration-200 shadow-sm">
                    {{ $lastPage }}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="flex items-center justify-center w-10 h-10 text-[#6A239B] bg-white border border-gray-300 rounded-full hover:bg-[#6A239B] hover:text-white transition-colors duration-200 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span class="flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-100 rounded-full cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif
        </div>

        
    </nav>
@endif
