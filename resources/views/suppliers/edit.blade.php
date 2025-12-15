<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Editar Proveedor
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

            <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nombre --}}
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nombre *
                    </label>
                    <input name="name" type="text"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                           value="{{ old('name', $supplier->name) }}">
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input name="email" type="email"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                           value="{{ old('email', $supplier->email) }}">
                </div>

                {{-- Teléfono --}}
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Teléfono
                    </label>
                    <input name="phone" type="text"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                           value="{{ old('phone', $supplier->phone) }}">
                </div>

                {{-- Dirección --}}
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Dirección
                    </label>
                    <input name="address" type="text"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                           value="{{ old('address', $supplier->address) }}">
                </div>

                {{-- Botones --}}
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('suppliers.index') }}"
                       class="px-4 py-2 border rounded dark:border-gray-600">
                        Cancelar
                    </a>

                    <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Actualizar
                    </button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>
