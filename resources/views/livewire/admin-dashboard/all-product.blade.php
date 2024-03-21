<div class="overflow-x-auto">

    <div wire:loading
        class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-60">
        <div class="spinner">
            <div class="min-h-6">
                <div class="">
                    <div class="container">
                        <div class="loadingspinner">
                            <div id="square1"></div>
                            <div id="square2"></div>
                            <div id="square3"></div>
                            <div id="square4"></div>
                            <div id="square5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('error') || session('success'))
        <livewire:flash-message />
    @endif
    @if($products && !$loading)
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Title</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Price</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Description</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Category</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Image</th>
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $product['id'] }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $product['title'] }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $product['price'] }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ strlen($product['description']) > 50 ? substr($product['description'], 0, 50) . '...' : $product['description'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">{{ $product['category'] }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <img src="{{ $product['image'] }}"
                                alt="{{ $product['title'] }}" class="h-10 w-10 rounded-full">
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap hover:cursor-pointer"
                            wire:click="delete({{ $product['id'] }})"
                            wire:confirm="Are you sure you want to delete {{ $product['title'] }}?">
                            <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-6 h-6 text-red-500 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
