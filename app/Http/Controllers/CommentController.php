<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{ 
    public function index()
    {
        return response()
            ->json(
                Comment::all(), 201
            );
    }

    public function get(int $id)
    {
        $comment = Comment::find($id);
        if($comment)
        {
            return response()
                ->json(
                    Comment::find($id), 201
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
                Comment::create([
                    'post_id' => $request->post_id,
                    'user_id' => $request->user_id,
                    'comment' => $request->comment
                ], 201
                )
            );
    }

    public function update(Request $request, int $id)
    {
        $comment = Comment::find($id);
        if($comment)
        {
            $comment->fill($request->all());
            $comment->save();
            
            return response()
                ->json(
                    $comment, 200
                );
        }
        else
        {
            return response()->json(['error' => 'Post inexistente'], 204);
        }

    }

    public function destroy(int $id)
    {
        $comment = Comment::find($id);
        
        if($comment)
        {
            Comment::destroy($id);
            return response()->json(['msg' => 'Usuário excluído com sucesso!'], 204);
        }
        else
        {
            return response()->json(['error' => 'Usuário inexistente'], 404);
        }
    }
}

