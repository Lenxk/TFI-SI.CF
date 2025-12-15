<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de venta
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <h3 class="text-lg font-semibold dark:text-gray-100 mb-4">Información general</h3>

                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Fecha:</strong>
                    {{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Total:</strong>
                    ${{ number_format($sale->total, 2, ',', '.') }}
                </p>

                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    <strong>Notas:</strong>
                    {{ $sale->notes ?? '—' }}
                </p>

                <h3 class="text-lg font-semibold dark:text-gray-100 mb-2">Productos vendidos</h3>

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b dark:border-gray-700 text-gray-600 dark:text-gray-300">
                            <th class="py-2">Producto</th>
                            <th class="py-2">Cantidad</th>
                            <th class="py-2">Precio unitario</th>
                            <th class="py-2">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($sale->items as $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2 text-gray-800 dark:text-gray-100">
                                    {{ $item->product->name }}
                                </td>

                                <td class="py-2 text-gray-800 dark:text-gray-100">
                                    {{ $item->quantity }}
                                </td>

                                <td class="py-2 text-gray-800 dark:text-gray-100">
                                    ${{ number_format($item->unit_price, 2, ',', '.') }}
                                </td>

                                <td class="py-2 text-gray-800 dark:text-gray-100">
                                    ${{ number_format($item->unit_price * $item->quantity, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('customer-sales.index') }}"
                       class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
