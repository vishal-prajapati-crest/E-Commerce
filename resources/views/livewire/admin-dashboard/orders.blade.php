<div>
    @if($orders)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Order ID</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Product</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Quantity</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Price</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            User</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Address</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Payment Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        @foreach($order['order_items'] as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    {{ $item['order']['id'] }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $order['title'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $item['quantity'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $item['price'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    {{ $item['order']['user']['name'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    {{ $item['order']['address'] }},
                                    {{ $item['order']['city'] }},
                                    {{ $item['order']['state'] }},
                                    {{ $item['order']['country'] }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    {{ $item['order']['payment_status'] == 1 ? 'Paid' : 'Pending' }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex flex-col justify-center items-center">
            <div class="text-center mt-4 font-medium">No Order found</div>
            <img class="h-64" src="{{ asset('no order.gif') }}" alt="no orders">
        </div>
    @endif
</div>
