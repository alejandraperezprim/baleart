<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Gestión de Comentarios</h1>

        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">Usuario</th>
                    <th class="p-3 border">Comentario</th>
                    <th class="p-3 border">Espacio</th>
                    <th class="p-3 border">Puntuación</th>
                    <th class="p-3 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr class="text-center border">
                        <td class="p-3">{{ $comment->user->name ?? 'Usuario desconocido' }}</td>
                        <td class="p-3">{{ $comment->comment }}</td>
                        <td class="p-3">{{ $comment->space->name ?? 'Sin espacio' }}</td>
                        <td class="p-3">{{ $comment->score }}</td>
                        <td class="p-3 flex justify-center gap-2">
                            <a href="#" class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                            <form action="#" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
