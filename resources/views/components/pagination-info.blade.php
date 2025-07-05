@props(['paginator', 'type' => 'entries'])

@if ($paginator->total() > 0)
    <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-3 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center space-x-4 mb-3 sm:mb-0">
            <!-- Results Info -->
            <div class="text-sm text-gray-700">
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ number_format($paginator->total()) }}</span>
                {{ $type }}
            </div>

            <!-- Per Page Selector -->
            <div class="flex items-center space-x-2">
                <label for="per_page" class="text-sm text-gray-600">Show:</label>
                <select name="per_page" id="per_page"
                    class="border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    onchange="updatePerPage(this.value)">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center space-x-2">
            <!-- First Page -->
            @if ($paginator->currentPage() > 1)
                <a href="{{ $paginator->url(1) }}" class="p-1 text-gray-400 hover:text-gray-600 transition-colors"
                    title="First Page">
                    <i class="fas fa-angle-double-left"></i>
                </a>
            @endif

            <!-- Previous Page -->
            @if ($paginator->onFirstPage())
                <span class="p-1 text-gray-300">
                    <i class="fas fa-angle-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="p-1 text-gray-400 hover:text-gray-600 transition-colors" title="Previous Page (←)">
                    <i class="fas fa-angle-left"></i>
                </a>
            @endif

            <!-- Page Info -->
            <div class="flex items-center space-x-1">
                <span class="text-sm text-gray-600">Page</span>
                <span class="font-medium text-blue-600">{{ $paginator->currentPage() }}</span>
                <span class="text-sm text-gray-600">of</span>
                <span class="font-medium text-gray-900">{{ $paginator->lastPage() }}</span>
            </div>

            <!-- Next Page -->
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="p-1 text-gray-400 hover:text-gray-600 transition-colors" title="Next Page (→)">
                    <i class="fas fa-angle-right"></i>
                </a>
            @else
                <span class="p-1 text-gray-300">
                    <i class="fas fa-angle-right"></i>
                </span>
            @endif

            <!-- Last Page -->
            @if ($paginator->currentPage() < $paginator->lastPage())
                <a href="{{ $paginator->url($paginator->lastPage()) }}"
                    class="p-1 text-gray-400 hover:text-gray-600 transition-colors" title="Last Page">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            @endif
        </div>
    </div>

    <!-- Keyboard Navigation Hint -->
    <div class="px-6 py-2 bg-blue-50 border-t border-blue-200">
        <div class="flex items-center justify-center text-xs text-blue-600">
            <i class="fas fa-keyboard mr-2"></i>
            <span>Tip: Use ← → arrow keys for quick navigation, Ctrl+K for search</span>
        </div>
    </div>
@else
    <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
        <div class="text-sm text-gray-500 text-center">
            No {{ $type }} found
            @if (request()->hasAny(['search', 'jenis_kelamin', 'role', 'status', 'kategori']))
                <a href="{{ url()->current() }}" class="text-blue-600 hover:text-blue-800 ml-2">
                    <i class="fas fa-times mr-1"></i>Clear filters
                </a>
            @endif
        </div>
    </div>
@endif
