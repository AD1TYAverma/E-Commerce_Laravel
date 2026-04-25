<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">Product Image</th>
                                <th class="px-4 py-2 border">Customer Name</th>
                                <th class="px-4 py-2 border">Address</th>
                                <th class="px-4 py-2 border">Phone</th>
                                <th class="px-4 py-2 border">Product Name</th>
                                <th class="px-4 py-2 border">Product Price</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th scope="col">Payment Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                            <tr class="text-center">
                                <td class="border p-2">
                                    <img src="{{ asset('products/'.$order->product->product_img) }}" width="80">
                                </td>
                                <td class="border p-2">{{ $order->user->name }}</td>
                                <td class="border p-2">{{ $order->receiver_address }}</td>
                                <td class="border p-2">{{ $order->receiver_phone }}</td>
                                <td class="border p-2">{{ $order->product->product_title }}</td>
                                <td class="border p-2">₹{{ $order->product->product_prices }}</td>
                                <td class="border p-2">{{ $order->status }}</td>
                                <td class="border p-2">{{$order->payment_status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>