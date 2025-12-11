<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Reporte de Ventas al Público
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Filtros --}}
        <form method="GET"
              class="bg-white dark:bg-gray-800 p-6 rounded shadow mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300">Desde</label>
                <input type="date" name="from" value="{{ request('from') }}"
                       class="mt-1 w-full rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200">
            </div>

            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300">Hasta</label>
                <input type="date" name="to" value="{{ request('to') }}"
                       class="mt-1 w-full rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200">
            </div>

            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300">Producto</label>
                <select name="product_id"
                        class="mt-1 w-full rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200">
                    <option value="">Todos</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" {{ request('product_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 w-full">
                    Aplicar filtros
                </button>
            </div>

        </form>

        {{-- Exportar --}}
        <a href="{{ route('reports.sales.export', request()->all()) }}"
           class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 inline-block mb-4">
            Exportar a Excel
        </a>

        {{-- Tabla --}}
        <div class="bg-white dark:bg-gray-800 rounded shadow p-6">
            @if($sales->isEmpty())
                <p class="text-center text-gray-500 dark:text-gray-400">
                    No hay resultados para los filtros seleccionados.
                </p>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-3 text-left">Fecha</th>
                            <th class="p-3 text-left">Total</th>
                            <th class="p-3 text-left">Cantidad de Items</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr class="border-t dark:border-gray-700">
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}
                                </td>

                                <td class="p-3">
                                    ${{ number_format($sale->total, 2, ',', '.') }}
                                </td>

                                <td class="p-3">
                                    {{ $sale->items->sum('quantity') }}
                                </td>

                                <td class="p-3 text-right">
                                    <a href="{{ route('customer-sales.show', $sale->id) }}"
                                       class="text-indigo-600 hover:underline">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</x-app-layout>
