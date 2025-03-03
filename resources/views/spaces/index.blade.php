<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Gestión de Espacios</h1>

        <!-- Botón para crear un nuevo espacio -->
        <div class="mb-4">
            <a href="{{ route('spaces.create') }}" class="bg-blue-500 text-white px-20 py-2 rounded hover:bg-blue-600 transition">Crear Nuevo Espacio</a>
        </div>

        <!-- Filtro -->
        <form method="GET" class="mb-4">
            <label class="mr-2">Ordenar por:</label>
            <select name="sort" onchange="this.form.submit()" class="border p-2 rounded">
                <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : '' }}>ID (Ascendente)</option>
                <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Fecha de Modificación</option>
                <option value="total_score" {{ request('sort') == 'total_score' ? 'selected' : '' }}>Total Score</option>
            </select>
        </form>

        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Total Score</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spaces as $space)
                        <tr class="text-center border border-gray-300 hover:bg-gray-100 transition">
                            <td class="p-3 border">{{ $space->id }}</td>
                            <td class="p-3 border">{{ $space->name }}</td>
                            <td class="p-3 border">{{ $space->totalScore ?? 'N/A' }}</td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="{{ route('spaces.edit', $space) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Editar</a>
                                <form action="{{ route('spaces.destroy', $space) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este espacio?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $spaces->links() }}
        </div>
    </div>
</x-app-layout>
