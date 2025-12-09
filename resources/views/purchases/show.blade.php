<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de compra
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

                {{-- Información general --}}
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    Información de la compra
                </h3>

                <p class="text-gray-700 dark:text-gray-300"><strong>Proveedor:</strong> {{ $purchase->supplier }}</p>
                <p class="text-gray-700 dark:text-gray-300"><strong>Fecha:</strong> 
                    {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y') }}
                </p>
                <p class="text-gray-700 dark:text-gray-300"><strong>Total:</strong> 
                    {{ $purchase->total ? '$' . number_format($purchase->total, 2, ',', '.') : '—' }}
                </p>

                @if($purchase->notes)
                    <p class="text-gray-700 dark:text-gray-300 mt-2"><strong>Notas:</strong> {{ $purchase->notes }}</p>
                @endif

                {{-- Ítems --}}
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mt-6 mb-2">
                    Ítems de la compra
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Producto
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Cantidad
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Precio unitario
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Lote
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Vencimiento
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($purchase->items as $item)
                                <tr>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                        {{ $item->product->name }}
                                    </td>

                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                        {{ $item->quantity }}
                                    </td>

                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                        {{ $item->unit_price ? '$' . number_format($item->unit_price, 2, ',', '.') : '—' }}
                                    </td>

                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                        {{ $item->lot_code ?? '—' }}
                                    </td>

                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                        {{ $item->expires_at ? \Carbon\Carbon::parse($item->expires_at)->format('d/m/Y') : '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                {{-- Botones --}}
              <div class="flex justify-between mt-6">

    {{-- Botón eliminar --}}
    <form action="{{ route('purchases.destroy', $purchase) }}" 
          method="POST"
          onsubmit="return confirm('¿Seguro que querés eliminar esta compra? Esto revertirá el stock y eliminará sus lotes.')">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            Eliminar compra
        </button>
    </form>

    {{-- Botón volver --}}
    <a href="{{ route('purchases.index') }}"
       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
        Volver
    </a>

</div>


            </div>
        </div>
    </div>
</x-app-layout>
