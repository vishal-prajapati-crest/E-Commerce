<!-- resources/views/cart.blade.php -->

<x-layout>
    <div class="bg-green-50 my-10">
        <div class="text-center font-medium text-4xl text-gray-800 p-4">
            Shopping Cart
        </div>
        @if(
            session()->has('cart') && count(session('cart')) > 0
            )
            <div class="grid grid-cols-3">
                @php
                    $totalAmount = 0;
                @endphp
                @foreach(session('cart') as $productId => $product)
                    <div
                        class="relative m-10 flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md">
                        <div class="mx-3 mt-3 flex h-60  rounded-xl">
                            <img class="object-cover mx-auto my-auto max-h-56"
                                src="{{ $product['image'] }}"
                                alt="{{ $product['title'] }}" />
                        </div>
                        <div class="mt-4 px-5 pb-5">
                            <h5 class="text-xl tracking-tight text-slate-900">
                                {{ $product['title'] }}</h5>
                            <p>Price: ${{ $product['price'] }}</p>
                            <p>Quantity:
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productId }}">
                                    <button type="submit" name="action" value="decrease"
                                        class="bg-gray-300 text-gray-700 px-3 py-1 rounded">-</button>
                                </form>
                                {{ $product['quantity'] }}
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productId }}">
                                    <button type="submit" name="action" value="increase"
                                        class="bg-gray-300 text-gray-700 px-3 py-1 rounded">+</button>
                                </form>
                            </p>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Remove</button>
                            </form>
                        </div>
                        @php
                            $subtotal = $product['price'] * $product['quantity'];
                            $totalAmount += $subtotal;
                        @endphp
                    </div>
                @endforeach
            </div>
            <div class="text-center font-medium text-2xl text-gray-800 p-4">
                Total Amount: ${{ $totalAmount }}
            </div>
        @else
            <div class="text-center text-gray-500 col-span-3">Your cart is empty</div>
        @endif
    </div>
</x-layout>
