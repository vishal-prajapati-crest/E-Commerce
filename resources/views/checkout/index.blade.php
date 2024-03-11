<x-layout>
    <form method="post" action="{{ route('checkout.store') }}" class="flex w-full justify-evenly ">
        @csrf
        @php
            $totalAmount = 0;
            $totalQty = 0;
        @endphp
        <div class="w-1/4 p-4">
            <h3 class="text-lg font-semibold mb-4 mt-4">Cart Items:</h3>
            <div class="border border-gray-950 p-4 rounded-md">

                @foreach(session('cart') as $item)
                    <div class="flex w-full mb-4">
                        <div class="w-1/2 mr-2"><img class="object-contain h-20"
                                src="{{ $item['image'] }}" alt="">
                        </div>
                        <div class="w-full flex flex-col justify-evenly">
                            <div class="font-medium">{{ $item['title'] }}</div>
                            <div>Price: {{ $item['price'] }}, Qty:
                                {{ $item['quantity'] }}
                            </div>
                        </div>
                    </div>
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $totalAmount += $subtotal;
                        $totalQty += $item['quantity'];
                    @endphp
                @endforeach
                <div class="flex justify-evenly">
                    <div class="font-medium">Total</div>
                    <div>${{ number_format($totalAmount,2) }}</div>
                </div>
            </div>
        </div>

        <div class="w-1/2 p-4">
            <h3 class="text-lg font-semibold mb-4 mt-4">Address Details:</h3>
            <div class="border p-4 rounded-md">
                <label for="address" class="block text-sm font-medium mb-1">Address<span
                        class="text-red-500">*</span></label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required
                    class="w-full mb-4 p-2 border border-gray-300">
                @error('address')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror


                <label for="city" class="block text-sm font-medium mb-1">City<span class="text-red-500">*</span></label>
                <input type="text" id="city" name="city" value="{{ old('city') }}" required
                    class="w-full mb-4 p-2 border border-gray-300">
                @error('city')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <label for="state" class="block text-sm font-medium mb-1">State<span
                        class="text-red-500">*</span></label>
                <input type="text" id="state" name="state" value="{{ old('state') }}" required
                    class="w-full mb-4 p-2 border border-gray-300">
                @error('state')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror


                <label for="country" class="block text-sm font-medium mb-1">Country<span
                        class="text-red-500">*</span></label>
                <input type="text" id="country" name="country" value="{{ old('country') }}" required
                    class="w-full mb-4 p-2 border border-gray-300">
                @error('country')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

            </div>
            <h3 class="text-lg font-semibold mb-4 mt-4">Card Details:</h3>
            <div class="border p-4 rounded-md">

                <!-- Card form -->
                <div class="space-y-4">
                    <!-- Card Number -->
                    <div>
                        <label class="block text-sm font-medium mb-1" for="card-nr">Card Number <span
                                class="text-red-500">*</span></label>
                        <input id="card-nr" name="card_number" value="{{ old('card_number') }}"
                            class="text-sm text-gray-800 bg-white border rounded leading-5 py-2 px-3 border-gray-200 hover:border-gray-300 focus:border-indigo-300 shadow-sm placeholder-gray-400 focus:ring-0 w-full"
                            type="text" placeholder="1234 1234 1234 1234" />
                        @error('card_number')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Expiry and CVC -->
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium mb-1" for="card-expiry">Expiry Date <span
                                    class="text-red-500">*</span></label>
                            <input id="card-expiry" name="card_expire"
                                value="{{ old('card_expire') }}"
                                class="text-sm text-gray-800 bg-white border rounded leading-5 py-2 px-3 border-gray-200 hover:border-gray-300 focus:border-indigo-300 shadow-sm placeholder-gray-400 focus:ring-0 w-full"
                                type="text" placeholder="MM/YY" />
                            @error('card_expire')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium mb-1" for="card-cvc">CVV <span
                                    class="text-red-500">*</span></label>
                            <input id="card-cvc" name="card_cvv"
                                class="text-sm text-gray-800 bg-white border rounded leading-5 py-2 px-3 border-gray-200 hover:border-gray-300 focus:border-indigo-300 shadow-sm placeholder-gray-400 focus:ring-0 w-full"
                                type="text" placeholder="CVV" />
                            @error('card_cvv')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Name on Card -->
                    <div>
                        <label class="block text-sm font-medium mb-1" for="card-name">Name on Card <span
                                class="text-red-500">*</span></label>
                        <input id="card-name" name="card_name" value="{{ old('card_name') }}"
                            class="text-sm text-gray-800 bg-white border rounded leading-5 py-2 px-3 border-gray-200 hover:border-gray-300 focus:border-indigo-300 shadow-sm placeholder-gray-400 focus:ring-0 w-full"
                            type="text" placeholder="John Doe" />
                        @error('card_name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <!-- Form footer -->
                <div class="mt-6">
                    <div class="mb-4">
                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">Place
                            order</button>

                    </div>
                    <div class="text-xs text-gray-500 italic text-center">You'll be charged
                        ${{ number_format($totalAmount,2) }}</div>
                </div>




            </div>
        </div>
    </form>

</x-layout>
