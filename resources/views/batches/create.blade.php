<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Agregar lote - {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('products.batches.store', $product) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 dark:text-gray-300">
                            Proveedor
                        </label>
                        <input type="text" name="supplier" value="{{ old('supplier') }}"
                               class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700
                                      dark:bg-gray-900 dark:text-gray-100">
                        @error('supplier')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 dark:text-gray-300">
                            Código de lote
                        </label>
                        <input type="text" name="lot_code" value="{{ old('lot_code') }}"
                               class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700
                                      dark:bg-gray-900 dark:text-gray-100">
                        @error('lot_code')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 dark:text-gray-300">
                            Cantidad *
                        </label>
                        <input type="number" name="quantity" value="{{ old('quantity') }}"
                               class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700
                                      dark:bg-gray-900 dark:text-gray-100">
                        @error('quantity')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 dark:text-gray-300">
                            Fecha de vencimiento
                        </label>
                        <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                               class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700
                                      dark:bg-gray-900 dark:text-gray-100">
                        @error('expires_at')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('products.batches.index', $product) }}"
                           class="px-4 py-2 rounded border dark:border-gray-600">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">
                            Guardar lote
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
