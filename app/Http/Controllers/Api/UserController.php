<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\GuardarUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //  LISTAR USUARIOS (BackOffice + API)
    public function index(Request $request)
    {
        $users = User::paginate(10);

        if ($request->wantsJson()) {
            return UserResource::collection($users);
        }

        return view('users.index', compact('users'));
    }

    //  MOSTRAR UN USUARIO (API)
    public function show(User $user)
    {
        $user->load('spaces', 'comments', 'comments.images');

        return (new UserResource($user))->additional(['meta' => 'Usuari mostrat correctament']);
    }

    //  CREAR USUARIO 
    public function store(GuardarUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->wantsJson()) {
            return (new UserResource($user))->additional(['meta' => 'Usuari creat correctament']);
        }

        return redirect()->route('users.index')->with('success', 'Usuari creat correctament.');
    }

    //  ACTUALIZAR USUARIO (BackOffice + API)
    public function update(GuardarUserRequest $request, User $user)
    {
        try {
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




    //  ELIMINAR USUARIO (BackOffice + API)
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
}

