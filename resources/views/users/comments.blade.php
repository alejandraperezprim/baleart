<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Comentarios de {{ $user->name }}</h1>

        @if($comments->isEmpty())
            <p class="text-center text-gray-500">Este usuario actualmente no tiene ningún comentario.</p>
        @else
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 border">Espacio</th>
                        <th class="p-3 border">Comentario</th>
                        <th class="p-3 border"></th>
                        <th class="p-3 border">Puntuación</th>
                        <th class="p-3 border">Fecha</th>
                        <th class="p-3 border">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr class="text-center border">
                            <td class="p-3">{{ $comment->space->name ?? 'Espacio desconocido' }}</td>
                            <td class="p-3">{!! $comment->comment !!}</td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="{{ route('comments.edit', $comment) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Editar</a>
                            </td>
                            <td class="p-3">{{ $comment->score }}</td>
                            <td class="p-3">{{ $comment->created_at->format('d-m-Y H:i') }}</td>
                            <td class="p-3">
                                <form action="{{ route('comments.toggleStatus', $comment) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" onchange="this.form.submit()" {{ $comment->status === 'y' ? 'checked' : '' }}>
                                        <div class="w-10 h-5 bg-gray-300 rounded-full relative transition peer-checked:bg-green-500">
                                            <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-1 peer-checked:left-5 transition"></div>
                                        </div>
                                        <span class="ml-2 text-sm font-medium text-gray-700">{{ $comment->status === 'y' ? 'Publicado' : 'No Publicado' }}</span>
                                    </label>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
