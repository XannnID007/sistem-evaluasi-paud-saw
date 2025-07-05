@props(['column', 'title'])

@php
    $currentSort = request('sort');
    $currentOrder = request('order', 'asc');
    $newOrder = $currentSort === $column && $currentOrder === 'asc' ? 'desc' : 'asc';
    $url = request()->fullUrlWithQuery(['sort' => $column, 'order' => $newOrder]);
@endphp

<th
    {{ $attributes->merge(['class' => 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors']) }}>
    <a href="{{ $url }}" class="flex items-center space-x-1 group">
        <span>{{ $title }}</span>
        <div class="flex flex-col">
            @if ($currentSort === $column)
                @if ($currentOrder === 'asc')
                    <i class="fas fa-chevron-up text-blue-600 text-xs"></i>
                @else
                    <i class="fas fa-chevron-down text-blue-600 text-xs"></i>
                @endif
            @else
                <i class="fas fa-sort text-gray-400 text-xs group-hover:text-gray-600"></i>
            @endif
        </div>
    </a>
</th>
