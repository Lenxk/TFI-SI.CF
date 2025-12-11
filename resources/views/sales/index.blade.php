<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ventas registradas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('sales.create') }}"
               class="px-4 py-2 bg-sky-600 text-white rounded hover:bg-sky-700 float-right mb-4">
                + Registrar venta
            </a>

            <table class="w-full bg-white dark:bg-gray-800 shadow rounded overflow-hidden">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="p-3 text-left">Fecha</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sales as $sale)
                        <tr class="border-t dark:border-gray-700">
                            <td class="p-3">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                            <td class="p-3">${{ number_format($sale->total, 2, ',', '.') }}</td>
                            <td class="p-3">
                                <a href="{{ route('sales.show', $sale) }}"
                                   class="text-sky-600 hover:underline">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">{{ $sales->links() }}</div>

        </div>
    </div>

</x-app-layout>
