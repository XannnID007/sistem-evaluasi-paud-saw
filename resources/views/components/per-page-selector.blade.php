@props(['perPage' => 10])

<div class="flex items-center space-x-2">
    <label for="per_page" class="text-sm text-gray-600">Show:</label>
    <select name="per_page" id="per_page"
        class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        onchange="updatePerPage(this.value)">
        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
    </select>
    <span class="text-sm text-gray-600">entries</span>
</div>

<script>
    function updatePerPage(value) {
        const url = new URL(window.location);
        url.searchParams.set('per_page', value);
        url.searchParams.delete('page'); // Reset to first page
        window.location.href = url.toString();
    }
</script>
