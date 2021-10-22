<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return response()
            ->json(
                Post::paginate(), 201
            );
    }

    public function get(int $id)
    {
        $post = Post::find($id);
        if($post)
        {
            return response()
                ->json(
                    Post::find($id), 201
                );
        }
        else
        {
            return response()->json(['error' => 'Post inexistente'], 204);
        }
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                Post::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'user_id' => $request->user_id
                ], 201
                )
            );
    }

    public function update(Request $request, int $id)
    {
        $post = Post::find($id);
        if($post)
        {
            $post->fill($request->all());
            $post->save();
            
            return response()
                ->json(
                    $post, 200
                );
        }
        else
        {
            return response()->json(['error' => 'Post inexistente'], 204);
        }

    }

    public function destroy(int $id)
    {
        $post = Post::find($id);
        if($post)
        {
            Post::destroy($id);
            return response()->json(['msg' => 'Usuário excluído com sucesso!'], 204);
        }
        else
        
        {
            return response()->json(['error' => 'Usuário inexistente'], 404);
        }
    }

    // actions relationship: comments

    public function getComments(int $post_id)
    {
        $postComments = Post::find($post_id)->Comments;
        if($postComments)
        {
            return response()->json($postComments, 201);
        }
        else
        {
            return response()
            ->json(['error' => 'Esse post não possui comentários'], 204);
        }
    }
}