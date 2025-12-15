<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Registrar venta al público
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('customer-sales.store') }}" method="POST">
                    @csrf

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label class="text-gray-700 dark:text-gray-300">Fecha *</label>
                        <input type="date" name="sale_date" required
                               class="block w-full mt-1 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" />
                    </div>

                    {{-- Notas --}}
                    <div class="mb-4">
                        <label class="text-gray-700 dark:text-gray-300">Notas</label>
                        <textarea name="notes" rows="2"
                                  class="block w-full mt-1 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"></textarea>
                    </div>

                    {{-- Ítems --}}
                    <h3 class="text-lg font-semibold dark:text-gray-100 mb-2">Productos vendidos</h3>

                    <table class="w-full mb-4">
                        <thead>
                            <tr class="text-gray-600 dark:text-gray-300">
                                <th class="py-2">Producto</th>
                                <th class="py-2 w-24">Cantidad</th>
                                <th class="py-2 w-24">Precio</th>
                                <th class="py-2 w-24">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="items-container"></tbody>
                    </table>

                    <button type="button"
                            onclick="addItemRow()"
                            class="mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        + Agregar producto
                    </button>

                    {{-- Total --}}
                    <div class="text-right mb-4">
                        <span class="text-gray-700 dark:text-gray-300 font-semibold text-lg">Total: </span>
                        <span id="total-amount" class="text-xl font-bold text-gray-900 dark:text-gray-100">$0.00</span>
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('customer-sales.index') }}"
                           class="px-4 py-2 rounded border dark:border-gray-600">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                            Guardar venta
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

    @php
        // Para evitar que el editor se queje con @json directamente en JS
        $productsJson = $products->toJson();
    @endphp

    {{-- SCRIPT --}}
    <script>
        const products = {!! $productsJson !!};

        function addItemRow() {
            const container = document.getElementById("items-container");
            const index = container.querySelectorAll("tr").length;

            const row = document.createElement("tr");
            row.classList.add("border-b", "dark:border-gray-700");

            row.innerHTML = `
                <td class="py-2">
                    <select name="items[${index}][product_id]" class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" onchange="updatePrice(this)">
                        <option value="">Seleccionar</option>
                        ${products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`).join('')}
                    </select>
                </td>

                <td class="py-2">
                    <input type="number" name="items[${index}][quantity]" value="1" min="1"
                           class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                           oninput="updateSubtotal(this)">
                </td>

                <td class="py-2">
                    <input type="text" name="items[${index}][unit_price]" readonly
                           class="price-field w-full bg-gray-100 dark:bg-gray-700 text-center rounded border border-gray-300 dark:border-gray-600">
                </td>

                <td class="py-2">
                    <input type="text" name="items[${index}][subtotal]" readonly
                           class="subtotal-field w-full bg-gray-100 dark:bg-gray-700 text-center rounded border border-gray-300 dark:border-gray-600">
                </td>

                <td class="py-2 text-center">
                    <button type="button" onclick="this.closest('tr').remove(); calculateTotal();" class="text-red-600 hover:underline">Eliminar</button>
                </td>
            `;

            container.appendChild(row);
        }

        function updatePrice(select) {
            const priceField = select.closest("tr").querySelector(".price-field");
            const selected = select.options[select.selectedIndex];

            if (selected && selected.dataset.price) {
                priceField.value = Number(selected.dataset.price).toFixed(2);
            } else {
                priceField.value = "";
            }

            updateSubtotal(select);
        }

        function updateSubtotal(input) {
            const row = input.closest("tr");
            const qty = row.querySelector("input[name*='quantity']").value;
            const price = row.querySelector(".price-field").value;

            const subtotal = qty && price ? qty * price : 0;
            row.querySelector(".subtotal-field").value = subtotal.toFixed(2);

            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;

            document.querySelectorAll(".subtotal-field").forEach(field => {
                total += Number(field.value || 0);
            });

            document.getElementById("total-amount").textContent = "$" + total.toFixed(2);
        }
    </script>
</x-app-layout>
