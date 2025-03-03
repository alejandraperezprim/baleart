<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Comentario</h1>

        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block text-lg font-medium text-gray-700">Comentario:</label>
            <textarea name="comment" id="editor" class="border p-2 w-full rounded">{{ old('comment', $comment->comment) }}</textarea>

            <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'))
            .catch(error => console.error(error));
    </script>
</x-app-layout>
