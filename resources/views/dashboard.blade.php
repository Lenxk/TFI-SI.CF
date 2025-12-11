<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Resumen de alertas --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                {{-- Productos con stock crítico --}}
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Productos con stock crítico
                    </h3>
                    <p class="mt-2 text-3xl font-bold text-red-600">
                        {{ $lowStockCount }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Stock por debajo del mínimo configurado.
                    </p>
                </div>

                {{-- Lotes por vencer --}}
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Lotes por vencer (30 días)
                    </h3>
                    <p class="mt-2 text-3xl font-bold text-yellow-500">
                        {{ $expiringSoonCount }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Revisar antes de que venzan.
                    </p>
                </div>

                {{-- Lotes vencidos --}}
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Lotes vencidos
                    </h3>
                    <p class="mt-2 text-3xl font-bold text-red-500">
                        {{ $expiredCount }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Retirar del stock físico.
                    </p>
                </div>

            </div>

            {{-- Listas detalladas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Productos con stock crítico --}}
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <h3 class="text-md font-semibold text-gray-800 dark:text-gray-100 mb-3">
                        Productos con stock crítico
                    </h3>

                    @if ($lowStockProducts->isEmpty())
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            No hay productos en estado crítico.
                        </p>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($lowStockProducts as $product)
                                <li class="py-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                            {{ $product->name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Stock: {{ $product->stock }} / Mínimo: {{ $product->min_stock }}
                                        </p>
                                    </div>

                                    <a href="{{ route('products.edit', $product) }}"
                                       class="text-xs text-sky-600 hover:underline">
                                        Ver producto
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Lotes por vencer --}}
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <h3 class="text-md font-semibold text-gray-800 dark:text-gray-100 mb-3">
                        Lotes por vencer (30 días)
                    </h3>

                    @if ($expiringSoonBatches->isEmpty())
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            No hay lotes próximos a vencer.
                        </p>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($expiringSoonBatches as $batch)
                                <li class="py-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                            {{ $batch->product->name }}
                                            @if ($batch->lot_code) (Lote: {{ $batch->lot_code }}) @endif
                                        </p>

                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Cantidad: {{ $batch->quantity }} —
                                            Vence: {{ $batch->expires_at->format('d/m/Y') }}
                                        </p>
                                    </div>

                                    <a href="{{ route('products.batches.index', $batch->product) }}"
                                       class="text-xs text-sky-600 hover:underline">
                                        Ver lotes
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>

           {{-- Tarjetas principales (Productos / Categorías / Compras) --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

    {{-- Tarjeta Productos --}}
    <a href="{{ route('products.index') }}"
       class="block bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
            Productos
        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Ver y gestionar los productos de la farmacia.
        </p>
    </a>

    {{-- Tarjeta Categorías --}}
    <a href="{{ route('categories.index') }}"
       class="block bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
            Categorías
        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Administrar categorías (Medicamentos, Perfumería, etc.).
        </p>
    </a>

    {{-- Tarjeta Compras --}}
    <a href="{{ route('purchases.index') }}"
       class="block bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
            Compras
        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Registrar compras y ver historial de ingresos.
        </p>
    </a>

     {{-- Tarjeta Reportes Ventas --}}
    <a href="{{ route('reports.sales') }}"
   class="block bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
        Reportes
    </h3>
    <p class="text-sm text-gray-600 dark:text-gray-300">
        Filtrar y exportar reportes de ventas.
    </p>
    </a>

     {{-- Tarjeta Reportes Compras --}}
    <a href="{{ route('reports.purchases') }}"
   class="block bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-md transition">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
        Reporte de Compras
    </h3>
    <p class="text-sm text-gray-600 dark:text-gray-300">
        Filtrar y exportar compras registradas.
    </p>
    </a>


</div>


        </div>
    </div>
</x-app-layout>
