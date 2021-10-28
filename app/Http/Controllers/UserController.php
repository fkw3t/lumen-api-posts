<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return new UserCollection(User::paginate($request->per_page));
    }

    public function get(int $id)
    {
        $user = User::find($id);
        if(!is_null($user))
        {
            return new UserResource($user);
        }
        else{
            return response()->json('Usuário não encontrado', 204);
        }
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user' => $request->user
        ]);
        return new UserResource($user);
    }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->fill($request->all());
            $user->save();
            
            return new UserResource($user);
        }
        else
        {
            return response()->json('Usuário inexistente', 204);
        }

    }

    public function destroy(int $id)
    {
        $user = User::find($id);

        if($user)
        {
            User::destroy($id);
            return response()->json('Usuário excluído com sucesso', 204);
        }
        else
        {
            return response()->json('Usuário inexistente', 404);
        }
    }

}

