<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 my-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filtro  -->
        <form method="GET" class="mb-4">
            <label class="mr-2">Ordenar por:</label>
            <select name="sort" onchange="this.form.submit()" class="border p-2 rounded">
                <option value="id_asc" {{ request('sort') == 'id_asc' ? 'selected' : ''}}> ID (ascendente) </option>
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Últimos creados</option>
                <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Últimos modificados</option>
            </select>
        </form>

        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Fecha de Creación</th>
                        <th class="p-3 border">Última Modificación</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="text-center border border-gray-300 hover:bg-gray-100 transition">
                            <td class="p-3 border">{{ $user->id }}</td>
                            <td class="p-3 border">{{ $user->name }}</td>
                            <td class="p-3 border">{{ $user->email }}</td>
                            <td class="p-3 border">{{ $user->created_at->format('d-m-Y H:i') }}</td>
                            <td class="p-3 border">{{ $user->updated_at->format('d-m-Y H:i') }}</td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="{{ route('users.comments', $user) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Comentarios</a>
                                <a href="{{ route('users.edit', $user) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">Editar</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
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
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
