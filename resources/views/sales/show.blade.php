<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalle de venta
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div id="invoice" class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow">

                {{-- Encabezado estilo factura --}}
                <div class="flex justify-between items-start mb-8">

                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Comprobante de venta</h1>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mt-1">Farmacia - Sistema de Gestión</p>
                    </div>

                    <div class="text-right">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Venta #{{ $sale->id }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Fecha: {{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}
                        </p>
                    </div>

                </div>

                {{-- Notas --}}
                @if ($sale->notes)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-100">Notas:</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $sale->notes }}</p>
                    </div>
                @endif

                {{-- Tabla de ítems --}}
                <table class="w-full border-collapse mb-6">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="p-3 text-left text-gray-700 dark:text-gray-200">Producto</th>
                            <th class="p-3 text-right text-gray-700 dark:text-gray-200">Cantidad</th>
                            <th class="p-3 text-right text-gray-700 dark:text-gray-200">Precio unitario</th>
                            <th class="p-3 text-right text-gray-700 dark:text-gray-200">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($sale->items as $item)
                            <tr>
                                <td class="p-3 text-gray-800 dark:text-gray-100">
                                    {{ $item->product->name }}
                                </td>

                                <td class="p-3 text-right text-gray-800 dark:text-gray-100">
                                    {{ $item->quantity }}
                                </td>

                                <td class="p-3 text-right text-gray-800 dark:text-gray-100">
                                    ${{ number_format($item->unit_price, 2, ',', '.') }}
                                </td>

                                <td class="p-3 text-right text-gray-800 dark:text-gray-100">
                                    ${{ number_format($item->unit_price * $item->quantity, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Total --}}
                <div class="flex justify-end mt-6">
                    <div class="text-right">
                        <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Total: ${{ number_format($sale->total, 2, ',', '.') }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- Botones --}}
            <div class="flex justify-between mt-6">

                {{-- Botón eliminar venta --}}
                <form action="{{ route('sales.destroy', $sale) }}" 
                      method="POST"
                      onsubmit="return confirm('¿Seguro que querés eliminar esta venta? Esto revertirá el stock.')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Eliminar venta
                    </button>
                </form>

                <div class="flex space-x-3">

                    {{-- Botón imprimir --}}
                    <button onclick="window.print()" 
                            class="px-4 py-2 bg-sky-600 text-white rounded hover:bg-sky-700">
                        Imprimir
                    </button>

                    {{-- Botón volver --}}
                    <a href="{{ route('sales.index') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Volver
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

{{-- Estilos para impresión --}}
<style>
@media print {
    nav, header, .hidden, .no-print {
        display: none !important;
    }

    #invoice {
        box-shadow: none !important;
        margin: 0;
        padding: 0;
    }
}
</style>
