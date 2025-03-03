<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    public function toggleStatus(Comment $comment)
    {
        try {
            // Alternar entre "y" (publicado) y "n" (no publicado)
            $comment->status = $comment->status === 'y' ? 'n' : 'y';
            $comment->save();

            return redirect()->back()->with('success', 'Estado del comentario actualizado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cambiar el estado: ' . $e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);
    
        try {
            $comment->update([
                'comment' => $request->comment,
            ]);
    
            return redirect()->route('users.comments', $comment->user_id)->with('success', 'Comentario actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.comments', $comment->user_id)->with('error', 'Error al modificar el comentario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
