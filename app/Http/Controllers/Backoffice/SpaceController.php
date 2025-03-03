<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Image;
use App\Models\Space;
use App\Models\Island;
use App\Models\Address;
use App\Models\Comment;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortOptions = [
            'id_asc' => ['id', 'asc'],
            'updated_at' => ['updated_at', 'desc'],
            'total_score' => ['totalScore', 'desc'], 
        ];
    
        $sortBy = $request->query('sort', 'id_asc');
        $orderBy = $sortOptions[$sortBy] ?? ['id', 'asc'];
    
        $spaces = Space::select('id', 'name', 'regNumber', 'totalScore')
            ->orderBy($orderBy[0], $orderBy[1])
            ->paginate(10);
    
        return view('spaces.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spaceTypes = SpaceType::all();
        $municipalities = Municipality::all();
        $islands = Island::all();
        return view('spaces.create', compact('spaceTypes','municipalities', 'islands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validar datos
        $request->validate([
            'name' => 'required|string|max:255',
            'regNumber' => 'required|string|max:10|unique:spaces,regNumber',
            'totalScore' => 'nullable|numeric|min:0',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
            'website' => 'nullable|url|max:255',
            'street_address' => 'required|string|max:255',
            'municipality_id' => 'required|exists:municipalities,id',
            'space_type_id' => 'required|exists:space_types,id',
            'observation_CA' => 'nullable|string',
            'observation_ES' => 'nullable|string',
            'observation_EN' => 'nullable|string',
            'services' => 'nullable|array',
            'modalities' => 'nullable|array',
        ]);

        try {
            // Obtener `island_id` desde el municipio seleccionado
            $municipality = Municipality::find($request->municipality_id);
            $island_id = $municipality ? $municipality->island_id : null;

            //  Crear la dirección 
            $address = Address::create([
                'name' => $request->street_address, 
                'municipality_id' => $request->municipality_id,
                'zone_id' => 1, 
            ]);

            //  Crear el espacio con la dirección creada y la isla obtenida del municipio
            $space = Space::create([
                'name' => $request->name,
                'regNumber' => $request->regNumber,
                'observation_CA' => $request->observation_CA,
                'observation_ES' => $request->observation_ES,
                'observation_EN' => $request->observation_EN,
                'email' => $request->email,
                'phone' => $request->phone,
                'website' => $request->website,
                'totalScore' => 0,
                'countScore' => 0,
                'space_type_id' => $request->space_type_id,
                'address_id' => $address->id, 
                'user_id' => 1, 
            ]);

            // Relación Many-to-Many con 'services'
            if ($request->has('services')) {
                $space->services()->attach($request->services);
            }

            //  Relación Many-to-Many con 'modalities'
            if ($request->has('modalities')) {
                $space->modalities()->attach($request->modalities);
            }

            return redirect()->route('spaces.index')->with('success', 'Espacio creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('spaces.create')->with('error', 'Error al crear el espacio: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Space $space)
    {
        return view('spaces.edit', compact('space'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Space $space)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'observation_CA' => 'nullable|string',
            'observation_ES' => 'nullable|string',
            'observation_EN' => 'nullable|string',
            'totalScore' => 'nullable|numeric|min:0',
        ]);
    
        try {
            $space->update([
                'name' => $request->name,
                'observation_CA' => $request->observation_CA,
                'observation_ES' => $request->observation_ES,
                'observation_EN' => $request->observation_EN,
                'totalScore' => $request->totalScore,
            ]);
    
            return redirect()->route('spaces.index')->with('success', 'Espacio actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('spaces.edit', $space)->with('error', 'Error al actualizar el espacio: ' . $e->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Space $space)
    {
        try {
            // Eliminar comentarios asociados al espacio
            $comments = Comment::where('space_id', $space->id)->get();
            foreach ($comments as $comment) {
                // Eliminar imágenes de los comentarios antes de borrar los comentarios
                $images = Image::where('comment_id', $comment->id)->get();
                foreach ($images as $image) {
                    $image->delete();
                }
                $comment->delete();
            }
    
            //  Eliminar relaciones Many-to-Many antes de eliminar el espacio
            $space->services()->detach();
            $space->modalities()->detach();
    
            //  Finalmente, eliminar el espacio
            $space->delete();
    
            return redirect()->route('spaces.index')->with('success', 'Espacio eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('spaces.index')->with('error', 'Error al eliminar el espacio: ' . $e->getMessage());
        }
    }
}
