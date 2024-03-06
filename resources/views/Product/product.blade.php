<x-layout>
    <!-- List all the category -->
    <div class="flex justify-evenly items-center pt-2 text-sm text-gray-600 hover:cursor-pointer">
        @if(! request()->has('category') )
            <a href="{{ route('products.index') }}"
                class="hover:underline text-blue-500 hover:text-gray-800">All</a>
        @else
            <a href="{{ route('products.index') }}"
                class="hover:underline hover:text-gray-800">All</a>


        @endif
        @foreach($categories as $category)

            @if(
                request()->has('category') && request()->query('category') === $category
                )
                <a href="?category={{ $category }}"
                    class="hover:underline  text-blue-500 hover:text-gray-800">{{ ucfirst($category) }}</a>
            @else
                <a href="?category={{ $category }}"
                    class="hover:underline hover:text-gray-800">{{ ucfirst($category) }}</a>

            @endif
        @endforeach
    </div>

    <!-- List all products -->
    <div class="bg-green-50 my-10">
        <div class="text-center font-medium text-4xl text-gray-800 p-4">
            All Products
        </div>
        <div class="grid grid-cols-3">
            @forelse($products as $product)

                <div
                    class="relative m-10 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
                    <a class="relative mx-3 mt-3 flex h-60  rounded-xl"
                        href="{{ route('products.show',$product['id']) }}">
                        <img class="object-cover mx-auto my-auto max-h-56"
                            src="{{ $product['image'] }}"
                            alt="{{ $product['title'] }}" />
                        @if(
                            date('Y-m-d', strtotime($product['created_date'])) >= date('Y-m-d', strtotime('-30 days'))
                            )
                            <span
                                class="absolute -top-5 -left-5 m-2 rounded-sm shadow-lg bg-red-500 px-2 text-center text-sm font-medium text-white">
                                New
                                Arrival</span>
                        @endif
                    </a>
                    <div class="mt-4 px-5 pb-5">
                        <a
                            href="{{ route('products.show',$product['id']) }}">
                            <h5 class="text-xl tracking-tight text-slate-900">
                                {{ $product['title'] }}</h5>
                        </a>
                        <div class="mt-2 mb-5 flex items-center justify-between">
                            <p>
                                <span
                                    class="text-3xl font-bold text-slate-900">${{ $product['price'] }}</span>
                            </p>

                            <div class="flex items-center">

                                @for($i=0; $i<5; $i++)
                                    @if($product['average_rating']<=$i)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            class="h-5 w-5 text-yellow-300" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                        </svg>

                                    @else
                                        <svg aria-hidden="true" class="h-5 w-5 text-yellow-300" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endif
                                @endfor

                                <span
                                    class="mr-2 ml-3 rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold">{{ $product['average_rating'] ? number_format($product['average_rating'], 1) : 'No rating' }}</span>
                            </div>
                        </div>
                        <a href="#"
                            class="flex items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to cart</a>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 col-span-3">No Product Found</div>
            @endforelse

        </div>
    </div>


</x-layout>
