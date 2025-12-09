<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registrar Compra
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('purchases.store') }}" method="POST">
                    @csrf

                    {{-- Datos de la compra --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">

                        {{-- Proveedor --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Proveedor *
                            </label>
                            <input type="text" name="supplier"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                          dark:bg-gray-900 dark:text-gray-100 shadow-sm"
                                   value="{{ old('supplier') }}" required>
                        </div>

                        {{-- Fecha de compra --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fecha *
                            </label>
                            <input type="date" name="purchase_date"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                          dark:bg-gray-900 dark:text-gray-100 shadow-sm"
                                   value="{{ old('purchase_date', now()->format('Y-m-d')) }}" required>
                        </div>

                    </div>

                    {{-- NOTAS --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Notas (opcional)
                        </label>
                        <textarea name="notes" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                         dark:bg-gray-900 dark:text-gray-100 shadow-sm">{{ old('notes') }}</textarea>
                    </div>

                    {{-- ÍTEMS DE LA COMPRA --}}
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        Items de la compra
                    </h3>

                    <div id="items">

                        {{-- ITEM PLANTILLA --}}
                        <div class="item-card bg-gray-50 dark:bg-gray-900 p-4 rounded-lg border border-gray-300 dark:border-gray-700 mb-4">

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                {{-- Producto --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Producto *
                                    </label>
                                    <select name="items[0][product_id]"
                                            class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700
                                                   dark:bg-gray-900 dark:text-gray-100 shadow-sm" required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Cantidad --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Cantidad *
                                    </label>
                                    <input type="number" name="items[0][quantity]"
                                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                                  dark:bg-gray-900 dark:text-gray-100 shadow-sm" required>
                                </div>

                                {{-- Precio unitario --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Precio unitario
                                    </label>
                                    <input type="number" step="0.01" name="items[0][unit_price]"
                                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                                                  dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                                </div>

                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">

                                {{-- Código de lote --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Código de lote
                                    </label>
                                    <input type="text" name="items[0][lot_code]"
                                           class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700
                                                  dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                                </div>

                                {{-- Fecha de vencimiento --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Vencimiento
                                    </label>
                                    <input type="date" name="items[0][expires_at]"
                                           class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700
                                                  dark:bg-gray-900 dark:text-gray-100 shadow-sm">
                                </div>

                            </div>

                            <button type="button"
                                    class="remove-item mt-3 text-red-600 hover:underline">
                                Eliminar ítem
                            </button>

                        </div>

                    </div>

                    {{-- Botón agregar ÍTEM --}}
                    <button type="button" id="add-item"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-4">
                        + Agregar ítem
                    </button>

                    {{-- Botones de acción --}}
                    <div class="flex justify-end space-x-2 mt-4">
                        <a href="{{ route('purchases.index') }}"
                           class="px-4 py-2 rounded-md border dark:border-gray-600">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Registrar compra
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    {{-- Script para duplicar ítems --}}
    <script>
        let itemIndex = 1;

        document.getElementById('add-item').addEventListener('click', function () {
            let template = document.querySelector('.item-card').cloneNode(true);

            template.querySelectorAll('input, select').forEach(el => {
                let name = el.getAttribute('name');
                el.setAttribute('name', name.replace('[0]', '[' + itemIndex + ']'));
                el.value = '';
            });

            document.getElementById('items').appendChild(template);
            itemIndex++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                if (document.querySelectorAll('.item-card').length > 1) {
                    e.target.closest('.item-card').remove();
                }
            }
        });
    </script>

</x-app-layout>
