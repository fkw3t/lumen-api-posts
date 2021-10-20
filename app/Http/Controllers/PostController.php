<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()
            ->json(
                Post::get(), 201
            );
    }

    public function get(int $id)
    {
        $post = Post::find($id);
        if($post)
        {
            return response()
                ->json(
                    $post, 201
                );
        }
        else
        {
            return response()->json(['error' => 'Post inexistente'], 204);
        }


    //     // return response()
    //     //     ->json(
    //     //         $user->select('id', 'user', 'name')
    //     //         ->get(), 201
    //     //     );
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                Post::create([
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'content' => $request->content
                ], 201
            )
        );
    }

    // public function update(Request $request, int $id)
    // {
    //     $user = User::find($id);
    //     if($user)
    //     {
    //         $user->fill($request->all());
    //         $user->save();
            
    //         return response()
    //             ->json(
    //                 $user, 200
    //             );
    //     }
    //     else
    //     {
    //         return response()->json(['error' => 'Usuário inexistente'], 204);
    //     }

    // }

    // public function destroy(int $id)
    // {
    //     $user = User::find($id);
        
    //     if($user)
    //     {
    //         User::destroy($id);
    //         return response()->json(['msg' => 'Usuário excluído com sucesso!'], 204);
    //     }
    //     else
    //     {
    //         return response()->json(['error' => 'Usuário inexistente'], 404);
    //     }
    // }

}