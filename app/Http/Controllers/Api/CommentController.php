<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Space;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CommentResource;


class CommentController extends Controller
{
    public function index(Request $request)
    { $comments = Comment::with('user', 'space')->get();

        return response()->json($comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'comentario' => $comment->comment,
                'usuario' => $comment->user->name ?? 'Anónimo',
                'puntuacion' => $comment->score,
                'fecha_creacion' => $comment->created_at->format('Y-m-d H:i:s'),
                'space_id' => $comment->space->id ?? null, // ✅ Asegurar que space_id se devuelve correctamente
            ];
        }));
    }


    public function getCommentsBySpaceId(int $spaceId)
    {
        $comments = Comment::where('space_id', $spaceId)->get();

        if ($comments->isEmpty()) {
            return response()->json(['message' => 'No hay comentarios para este espacio'], 404);
        }

        return response()->json(CommentResource::collection($comments), 200);
    }

    public function getCommentsBySpace(Space $space) {
        $comments = $space->comments()->with('user')->get();
    
        if ($comments->isEmpty()) {
            return response()->json(['message' => 'No comments found for this space'], 200);
        }
    
        return response()->json($comments);
    }
    

    public function store(Request $request, Space $space)
{
    $request->validate([
        'comment' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'user_id' => 'required|exists:users,id',
    ]);

    $comment = $space->comments()->create([
        'comment' => $request->comment,
        'score' => $request->rating,
        'user_id' => $request->user_id,
        'status' => 'y', // Publicar directamente
    ]);

    return response()->json(['message' => 'Comentario guardado con éxito', 'comment' => $comment], 201);
}

public function getCommentsByUser($userId)
{
    // 🔹 Obtener solo los comentarios que pertenecen al usuario autenticado
    $comments = Comment::where('user_id', $userId)->with('space')->get();

    if ($comments->isEmpty()) {
        return response()->json(['message' => 'No hay comentarios para este usuario'], 200);
    }

    return response()->json(CommentResource::collection($comments));
}







}