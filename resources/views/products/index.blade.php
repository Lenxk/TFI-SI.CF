<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Productos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    Productos
                </h3>

                <a href="{{ route('products.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        + Agregar producto
                </a>
            </div>


            @if ($products->count() === 0)
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow flex items-center justify-between">
                    <p class="text-gray-600 dark:text-gray-300">
                        Todavía no hay productos cargados.
                    </p>
                </div>
            @else

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white dark:bg-gray-800 p-4 shadow rounded flex flex-col">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="w-full h-40 object-cover rounded mb-2">
                            @endif

                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">
                                {{ $product->name }}
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $product->category->name ?? 'Sin categoría' }}
                            </p>

                            <p class="mt-1 font-semibold text-gray-800 dark:text-gray-200">
                                ${{ number_format($product->price, 2, ',', '.') }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Stock: {{ $product->stock }}
                            </p>

                            @if ($product->description)
                                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 line-clamp-3">
                                    {{ $product->description }}
                                </p>
                            @endif

                            <div class="mt-auto pt-3 flex justify-between items-center">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="text-blue-600 hover:underline">
                                    Editar
                                </a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que querés eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
