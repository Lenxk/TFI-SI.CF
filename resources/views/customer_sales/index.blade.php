<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ventas al público
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold dark:text-gray-100">Listado de ventas</h3>

                <a href="{{ route('customer-sales.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                    + Registrar venta
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b dark:border-gray-700 text-gray-600 dark:text-gray-300">
                            <th class="py-2 px-3">Fecha</th>
                            <th class="py-2 px-3">Total</th>
                            <th class="py-2 px-3">Notas</th>
                            <th class="py-2 px-3"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sales as $sale)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2 px-3 text-gray-800 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}
                                </td>

                                <td class="py-2 px-3 text-gray-800 dark:text-gray-100">
                                    ${{ number_format($sale->total, 2, ',', '.') }}
                                </td>

                                <td class="py-2 px-3 text-gray-600 dark:text-gray-400">
                                    {{ $sale->notes ?? '—' }}
                                </td>

                                <td class="py-2 px-3 text-right">
                                    <a href="{{ route('customer-sales.show', $sale) }}"
                                       class="text-indigo-600 hover:underline">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-600 dark:text-gray-400">
                                    No hay ventas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $sales->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
