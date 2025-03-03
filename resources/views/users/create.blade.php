<x-app-layout>
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <label class="block mb-2">Nombre:</label>
        <input type="text" name="name" required class="border p-2 w-full rounded">

        <label class="block mt-4 mb-2">Email:</label>
        <input type="email" name="email" required class="border p-2 w-full rounded">

        <label class="block mt-4 mb-2">Contraseña:</label>
        <input type="password" name="password" required class="border p-2 w-full rounded">

        <label class="block mt-4 mb-2">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" required class="border p-2 w-full rounded">

        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</div>
</x-app-layout>
