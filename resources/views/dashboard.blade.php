<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Panel de Administración</h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <a href="{{ route('users.index') }}" class="block bg-blue-500 text-white text-center py-4 rounded-lg shadow hover:bg-blue-600 transition">
                Gestión de Usuarios
            </a>
            <a href="{{ route('spaces.index') }}" class="block bg-green-500 text-white text-center py-4 rounded-lg shadow hover:bg-green-600 transition">
                Gestión de Espacios
            </a>
        </div>
    </div>
</x-app-layout>
