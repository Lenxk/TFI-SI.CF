<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Stock por lote - {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-between items-center">
                <div>
                    <p class="text-gray-700 dark:text-gray-200">
                        Stock total: <span class="font-bold">{{ $product->stock }}</span>
                    </p>
                </div>

                <a href="{{ route('products.batches.create', $product) }}"
                   class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">
                    + Agregar lote
                </a>
            </div>

            @if ($batches->isEmpty())
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <p class="text-gray-600 dark:text-gray-300">
                        No hay lotes cargados para este producto.
                    </p>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="px-3 py-2 text-left">Lote</th>
                                <th class="px-3 py-2 text-left">Proveedor</th>
                                <th class="px-3 py-2 text-left">Cantidad</th>
                                <th class="px-3 py-2 text-left">Vencimiento</th>
                                <th class="px-3 py-2 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batches as $batch)
                                <tr class="border-b border-gray-100 dark:border-gray-700">
                                    <td class="px-3 py-2">
                                        {{ $batch->lot_code ?? '—' }}
                                    </td>
                                    <td class="px-3 py-2">
                                        {{ $batch->supplier ?? '—' }}
                                    </td>
                                    <td class="px-3 py-2">
                                        {{ $batch->quantity }}
                                    </td>
                                    <td class="px-3 py-2">
                                        {{ $batch->expires_at ? $batch->expires_at->format('d/m/Y') : 'Sin fecha' }}
                                    </td>
                                    <td class="px-3 py-2 text-right space-x-2">
                                        <a href="{{ route('batches.edit', $batch) }}"
                                           class="text-blue-600 hover:underline">
                                            Editar
                                        </a>

                                        <form action="{{ route('batches.destroy', $batch) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('¿Eliminar este lote?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:underline">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
