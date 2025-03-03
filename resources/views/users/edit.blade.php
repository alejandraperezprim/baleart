<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

        <form action="{{ route('users.update', $user) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <label class="block mb-2">Nombre:</label>
            <input type="text" name="name" value="{{ $user->name }}" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Apellidos:</label>
            <input type="text" name="lastname" value="{{ $user->lastname }}" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Teléfono:</label>
            <input type="text" name="phone" value="{{ $user->phone }}" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Correo:</label>
            <input type="email" name="email" value="{{ $user->email }}" required class="border p-2 w-full rounded">

            <button type="submit" class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Actualizar</button>
        </form>
    </div>
</x-app-layout>
