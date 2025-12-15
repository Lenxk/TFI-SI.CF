<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Compras registradas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Botón registrar compra --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('purchases.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    + Registrar compra
                </a>
            </div>

            {{-- Tabla de compras --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($purchases->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">
                        No hay compras registradas todavía.
                    </p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Fecha
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Proveedor
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Total
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Acciones
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Proveedor
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ $purchase->supplier?->name ?? 'Sin proveedor' }}
                                    </td>

                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                                    {{ $purchase->total ? '$' . number_format($purchase->total, 2, ',', '.') : '—' }}
                                    </td>

                                    <td class="px-4 py-2 flex space-x-3">

                        {{-- Ver --}}
                            <a href="{{ route('purchases.show', $purchase) }}"
                            class="text-blue-600 hover:underline">
                                Ver
                            </a>

                        {{-- Eliminar --}}
                            <form action="{{ route('purchases.destroy', $purchase) }}" 
                            method="POST"
                            onsubmit="return confirm('¿Seguro que querés eliminar esta compra? Esto revertirá el stock.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">
                            Eliminar
                            </button>
                        </form>

                        </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="mt-4">
                        {{ $purchases->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
