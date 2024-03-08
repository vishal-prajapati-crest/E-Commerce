<!-- resources/views/cart.blade.php -->

<x-layout>
    <div class="bg-green-50 my-10">
        <div class="text-center font-medium text-4xl text-gray-800 p-4">
            Shopping Cart
        </div>
        @if(
            session()->has('cart') && count(session('cart')) > 0
            )
            @php
                $totalAmount = 0;
                $totalQty = 0;
            @endphp
            <div class=" mx-20 my-auto">
                <table class="table-auto border-separate border-spacing-2">
                    <thead>
                        <tr>
                            <th>sr.</th>
                            <th class="w-28">Image</th>
                            <th class="w-1/2">Title</th>
                            <th class="w-36">QTY.</th>
                            <th class="w-36">Price</th>
                            <th class="w-44">Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(
                            session('cart') as $productId => $product
                            )
                            <tr class="gap-10">
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="bg-white rounded-md">
                                    <img class="object-cover h-20 mx-auto my-auto max-h-56"
                                        src="{{ $product['image'] }}"
                                        alt="{{ $product['title'] }}" />
                                </td>
                                <td>
                                    <a
                                        href="{{ route('products.show', $productId) }}">{{ $product['title'] }}</a>
                                </td>
                                <td class="text-center flex items-center justify-center my-7 gap-3">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $productId }}">
                                        @if($product['quantity'] == 1)
                                            <button disabled type="submit" name="action" value="decrease"
                                                class=" bg-primary-300 text-slate-100 px-1 py-1 flex items-center  rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                </svg>

                                            </button>
                                        @else

                                            <button type="submit" name="action" value="decrease"
                                                class="bg-primary-500 text-slate-100 px-1 py-1  flex items-center  rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                </svg>
                                            </button>
                                        @endif
                                    </form>
                                    {{ $product['quantity'] }}
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $productId }}">
                                        <button type="submit" name="action" value="increase"
                                            class="bg-primary-500 text-slate-100 px-1 py-1  flex items-center  rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>

                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    ${{ $product['price'] }}
                                </td>
                                @php
                                    $subtotal = $product['price'] * $product['quantity'];
                                    $totalAmount += $subtotal;
                                    $totalQty += $product['quantity'];
                                @endphp
                                <td class="text-center">
                                    ${{ number_format($subtotal,2) }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $productId }}">
                                        <button type="submit" class="bg-red-500 text-white px-1 py-1 rounded"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right font-bold">Total Qty.</td>
                            <td class="text-center font-semibold">{{ $totalQty }}</td>
                            <td class="text-right font-bold">Grand Total</td>
                            <td class="text-center font-semibold">${{ number_format($totalAmount,2) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <a href="#">Checkout</a>
                </div>
            </div>


        @else
            <div class="text-center text-gray-500 col-span-3">Your cart is empty</div>
            <div class="text-center">

                <a class="text-center text-primary-500 col-span-3"
                    href="{{ route('products.index') }}">Shop now</a>
            </div>
        @endif
    </div>
</x-layout>
