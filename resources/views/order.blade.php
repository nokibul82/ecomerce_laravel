<x-app-layout>

<div class="relative overflow-x-auto px-16 py-10">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Order ID
                </th>
                <th scope="col" class="px-6 py-3">
                    User Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Amout
                </th>
                <th scope="col" class="px-6 py-3">
                    Ordered At
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($orders as $order)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$order->id}}
                </th>
                <td class="px-6 py-4">
                    {{$order->name}}
                </td>
                <td class="px-6 py-4">
                    ${{$order->total}}
                </td>
                <td class="px-6 py-4">
                    {{$order->created_at}}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

</x-app-layout>