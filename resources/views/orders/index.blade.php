<x-layout>
    <div class="flex justify-center">
        <table class="w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="w-28">Order Id</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $data)
                    <tr>
                        <td class="text-center">{{ $data['id'] }}</td>
                        <td>
                            {{ substr($data['order_items'][0]['product']['title'], 0, 80)."..." }}
                        </td>
                        <td class="text-center">
                            {{ number_format($data['total_amount'], 2) }}
                        </td>
                        <td class="text-green-500 text-center">Confirmed</td>
                        <td class="flex items-center justify-center">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</x-layout>
