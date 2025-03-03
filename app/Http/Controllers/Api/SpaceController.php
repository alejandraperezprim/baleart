<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\SpaceResource;


class SpaceController extends Controller
{
    
/*
    public function index()
    {
        // SELECCIÓ DE LES DADES
        //$spaces = Space::all();
        $spaces = Space::with(["address", "modalities", "services", "spaceType", "comments", "comments.images", "user"])->get();

        // SELECCIÓ DE LA RESPOSTA
        //return response()->json($spaces);  // --> torna una resposta serialitzada en format 'json'
        return (SpaceResource::collection($spaces))->additional(['meta' => 'Espais mostrats correctament']);  // torna una resposta personalitzada
    }
*/

public function index(Request $request)
{
    $query = Space::with([
        "address",
        "address.municipality.island",
        "modalities",
        "services",
        "spaceType",
        "comments",
        "comments.images",
        "user",
    ]);

    // Aplicar filtro por 'illa' si está presente
    $query->when($request->illa, function ($q) use ($request) {
        $q->whereHas('address.municipality.island', function ($q) use ($request) {
            $q->where('name', $request->illa);
        });
    });

    // Obtener los espacios
    $spaces = $query->get()->map(function ($space) {
        return [
            'id' => $space->id,  
            'registre' => $space->regNumber,
            'nom' => $space->name,
            'tipus' => $space->spaceType->name ?? 'Sin tipo',
            'modalitats' => $space->modalities->pluck('name')->toArray(),
            'municipi' => $space->address->municipality->name ?? 'Desconocido',
            'serveis' => $space->services->pluck('name')->toArray(),
            'rating' => $space->comments->avg('score') ?? 0, // Promedio de puntuación
            'numComments' => $space->comments->count(), // Cantidad de comentarios
        ];
    });

    return response()->json($spaces);
}



public function show(Space $space)
{
    $space->load([
        "address",
        "address.municipality.island",
        "modalities",
        "services",
        "spaceType",
        "comments",
        "comments.images",
        "user",
    ]);

    return response()->json([
        'id' => $space->id,  
        'registre' => $space->regNumber,
        'nom' => $space->name,
        'observacions_ES' => $space->observation_ES ?? 'No disponible',
        'tipus' => $space->spaceType->name ?? 'Sin tipo',
        'modalitats' => $space->modalities->pluck('name')->toArray(),
        'municipi' => $space->address->municipality->name ?? 'Desconocido',
        'adreça' => $space->address->name ?? 'No especificada', 
        'telefon' => $space->phone ?? 'No disponible', 
        'email' => $space->email ?? 'No disponible', 
        'serveis' => $space->services->pluck('name')->toArray(),
        'rating' => $space->comments->avg('score') ?? 0,
        'numComments' => $space->comments->count(),
        'comentarios' => $space->comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'comentario' => $comment->comment,
                'usuario' => $comment->user->name ?? 'Anónimo',
                'puntuacion' => $comment->score,
            ];
        }),
    ]);
}

}
