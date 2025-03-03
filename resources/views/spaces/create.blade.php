<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Crear Nuevo Espacio</h1>

        <form action="{{ route('spaces.store') }}" method="POST">
            @csrf

            <label class="block mb-2">Nombre:</label>
            <input type="text" name="name" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Número de Registro:</label>
            <input type="text" name="regNumber" required class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Teléfono:</label>
            <input type="text" name="phone" class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Correo Electrónico:</label>
            <input type="email" name="email" class="border p-2 w-full rounded">

            <label class="block mt-4 mb-2">Sitio Web:</label>
            <input type="url" name="website" class="border p-2 w-full rounded">

            <!-- Tipo de Espacio -->
            <label class="block mt-4 mb-2">Tipo de Espacio:</label>
            <select name="space_type_id" class="border p-2 w-full rounded" required>
                @foreach($spaceTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>

            <!-- Dirección manual -->
            <label class="block mt-4 mb-2">Dirección:</label>
            <input type="text" name="street_address" required class="border p-2 w-full rounded">

            <!-- Selección de Municipio -->
            <label class="block mt-4 mb-2">Municipio:</label>
            <select name="municipality_id" class="border p-2 w-full rounded">
                @foreach($municipalities as $municipality)
                    <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                @endforeach
            </select>

            <!-- Selección de Isla -->
            <label class="block mt-4 mb-2">Isla:</label>
            <select name="island_id" class="border p-2 w-full rounded">
                @foreach($islands as $island)
                    <option value="{{ $island->id }}">{{ $island->name }}</option>
                @endforeach
            </select>

            <!-- Usuario asignado por defecto -->
            <input type="hidden" name="user_id" value="1">
            <!-- Zona asignada por defecto -->
            <input type="hidden" name="zone_id" value="1">
            <!-- TotalScore por defecto -->
             <input type="hidden" name="totalScore" value="0">

            <!-- Observaciones con CKEditor -->
            <label class="block mt-4 mb-2">Observaciones (CA):</label>
            <textarea name="observation_CA" id="editor_ca" class="border p-2 w-full rounded"></textarea>

            <label class="block mt-4 mb-2">Observaciones (ES):</label>
            <textarea name="observation_ES" id="editor_es" class="border p-2 w-full rounded"></textarea>

            <label class="block mt-4 mb-2">Observaciones (EN):</label>
            <textarea name="observation_EN" id="editor_en" class="border p-2 w-full rounded"></textarea>

            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Guardar Espacio</button>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor_ca'));
        ClassicEditor.create(document.querySelector('#editor_es'));
        ClassicEditor.create(document.querySelector('#editor_en'));
    </script>
</x-app-layout>
