<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Auditoría del Sistema
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">

        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="p-2">Fecha</th>
                        <th class="p-2">Usuario</th>
                        <th class="p-2">Acción</th>
                        <th class="p-2">Modelo</th>
                        <th class="p-2">ID</th>
                        <th class="p-2">Cambios</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($audits as $audit)
                        <tr class="border-b dark:border-gray-700">
                            <td class="p-2">{{ $audit->created_at }}</td>
                            <td class="p-2">{{ $audit->user_id }}</td>
                            <td class="p-2">{{ $audit->action }}</td>
                            <td class="p-2">{{ $audit->model }}</td>
                            <td class="p-2">{{ $audit->model_id }}</td>
                            <td class="p-2 text-xs">
                                <pre class="whitespace-pre-wrap text-gray-600 dark:text-gray-300">
                                    {{ json_encode($audit->changes, JSON_PRETTY_PRINT) }}
                                </pre>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $audits->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
