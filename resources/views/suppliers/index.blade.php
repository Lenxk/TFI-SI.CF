<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Proveedores
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">

        <div class="flex justify-end mb-4">
            <a href="{{ route('suppliers.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Nuevo proveedor
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow p-6 rounded">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="p-2 text-left">Nombre</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Teléfono</th>
                        <th class="p-2 text-left">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($suppliers as $s)
                        <tr class="border-b dark:border-gray-700">
                            <td class="p-2">{{ $s->name }}</td>
                            <td class="p-2">{{ $s->email }}</td>
                            <td class="p-2">{{ $s->phone }}</td>

                            <td class="p-2 flex space-x-2">
                                <a href="{{ route('suppliers.edit', $s) }}"
                                   class="text-blue-600 hover:underline">Editar</a>

                                <form method="POST"
                                      action="{{ route('suppliers.destroy', $s) }}"
                                      onsubmit="return confirm('¿Eliminar proveedor?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="mt-4">
                {{ $suppliers->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
