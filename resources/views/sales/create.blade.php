<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registrar venta
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700">Fecha *</label>
                        <input type="date" name="sale_date"
                               class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white">
                    </div>

                    {{-- Notas --}}
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700">Notas</label>
                        <textarea name="notes" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-900 dark:text-white"></textarea>
                    </div>

                    {{-- Ítems --}}
                    <h3 class="text-md font-semibold mb-2">Productos vendidos</h3>

                    <table class="w-full text-sm mb-4" id="itemsTable">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <button type="button"
                            onclick="addItem()"
                            class="px-3 py-1 bg-sky-600 text-white rounded">
                        + Agregar producto
                    </button>

                    {{-- Botones --}}
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">
                            Guardar venta
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        let products = @json($products);

        function addItem() {
            const tbody = document.querySelector('#itemsTable tbody');

            let row = document.createElement('tr');

            row.innerHTML = `
                <td>
                    <select name="items[][product_id]" class="border rounded p-1 w-full">
                        ${products.map(p => `<option value="${p.id}">${p.name}</option>`).join('')}
                    </select>
                </td>

                <td>
                    <input type="number" name="items[][quantity]" min="1" value="1"
                           class="border rounded p-1 w-full">
                </td>

                <td>
                    <button type="button" onclick="this.parentElement.parentElement.remove()"
                            class="text-red-600">
                        Eliminar
                    </button>
                </td>
            `;

            tbody.appendChild(row);
        }
    </script>

</x-app-layout>
