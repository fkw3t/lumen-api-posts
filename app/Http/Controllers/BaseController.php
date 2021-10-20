<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

abstract class BaseController extends Controller
{
    public function index()
    {
        return response()
            ->json(
                User::select('id', 'user', 'name')
                ->get(), 201
            );
    }

    public function get(int $id)
    {
        $user = User::find($id);
        if($user)
        {
            return response()
                ->json(
                    $user->select('id', 'user', 'name')
                    ->get(), 201
                );
        }
        else
        {
            return response()->json(['error' => 'Usuário inexistente'], 204);
        }


        // return response()
        //     ->json(
        //         $user->select('id', 'user', 'name')
        //         ->get(), 201
        //     );
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash("md5" ,$request->password),
                    'user' => $request->user
                ], 201
                )
            );
    }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->fill($request->all());
            $user->save();
            
            return response()
                ->json(
                    $user, 200
                );
        }
        else
        {
            return response()->json(['error' => 'Usuário inexistente'], 204);
        }

    }

    public function destroy(int $id)
    {
        $user = User::find($id);
        
        if($user)
        {
            User::destroy($id);
            return response()->json(['msg' => 'Usuário excluído com sucesso!'], 204);
        }
        else
        {
            return response()->json(['error' => 'Usuário inexistente'], 404);
        }
    }

}

