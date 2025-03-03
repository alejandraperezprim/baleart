<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //verificamos si queremos ordenar por id, fecha de creación o modificación

        $sortOptions = [
            'id_asc' => ['id', 'asc'],
            'created_at' => ['created_at', 'desc'],
            'updated_at' => ['updated_at', 'desc'],
        ];

        $orderBy = $request->query('sort', 'id_asc');
        $orderBy = $sortOptions[$orderBy] ?? ['id', 'asc'];

        $users = User::orderBy($orderBy[0], $orderBy[1])->paginate(10);

        return view('users.index', compact('users'));
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

    

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        try{
            $user->update([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'email' => $request->email, 
            ]);

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Error al modificar el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
                $comments = Comment::where('user_id', $user->id)->get();
                foreach ($comments as $comment) {
                    $images = Image::where('comment_id', $comment->id)->get();
                    foreach ($images as $image) {
                        $image->delete();
                    }
                    $comment->delete();
                }

                $user->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar l\'usuari: ' . $e->getMessage()], 500);
        }

        if (request()->wantsJson()) {
            return response()->json(['meta' => 'Usuari eliminat correctament']);
        }

        return redirect()->route('users.index')->with('success', 'Usuari eliminat correctament.');
        
    }

    public function comments(User $user)
    {
        $comments = $user->comments()->with('space')->paginate(10);

        return view('users.comments', compact('user', 'comments'));
    }
}
