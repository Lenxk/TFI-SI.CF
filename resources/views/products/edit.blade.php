<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar producto
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nombre *
                        </label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                      dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Descripción
                        </label>
                        <textarea name="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                         dark:bg-gray-900 dark:text-gray-100 shadow-sm">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Precio --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Precio *
                        </label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                      dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                        @error('price')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stock --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Stock *
                        </label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                      dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                        @error('stock')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Categoría --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Categoría *
                        </label>
                        <select name="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                       dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                            <option value="">Seleccionar</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Imagen --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Imagen
                        </label>

                        @if ($product->image)
                            <div class="mb-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Imagen actual:</p>
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif

                        <input type="file" name="image"
                               class="mt-1 block w-full text-gray-700 dark:text-gray-200">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Si no seleccionás nada, se mantiene la imagen actual.
                        </p>
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('products.index') }}"
                           class="px-4 py-2 rounded-md border dark:border-gray-600">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Actualizar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
