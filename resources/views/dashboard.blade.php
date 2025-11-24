<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

                {{-- Podés agregar más tarjetas después (Clientes, Pedidos, etc.) --}}

            </div>

        </div>
    </div>
</x-app-layout>
