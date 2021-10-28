<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{ 
    public function index(Request $request)
    {
        return new CommentCollection(Comment::paginate($request->per_page));
    }

    public function get(int $id)
    {
        $comment = Comment::find($id);
        if(!is_null($comment))
        {
            return new CommentResource($comment);
        }
        else{
            return response()->json('Comentário não encontrado', 204);
        }
    }

    public function store(Request $request)
    {
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'comment' => $request->comment
        ]);
        return new CommentResource($comment);
    }

    public function update(Request $request, int $id)
    {
        $comment = Comment::find($id);
        if($comment)
        {
            $comment->fill($request->all());
            $comment->save();
            
            return new CommentResource($comment);
        }
        else
        {
            return response()->json('Post inexistente', 204);
        }

    }

    public function destroy(int $id)
    {
        $comment = Comment::find($id);
        
        if($comment)
        {
            Comment::destroy($id);

            return response()->json('Usuário excluído com sucesso!', 204);
        }
        else
        {
            return response()->json('Usuário inexistente', 404);
        }
    }
}

