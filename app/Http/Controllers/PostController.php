<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return new PostCollection(Post::paginate($request->per_page));
    }

    public function get(int $id)
    {
        $post = Post::find($id);
        if(!is_null($post))
        {
            return new PostResource($post);
        }
        else{
            return response()->json('Post não encontrado', 204);
        }
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);
        return new PostResource($post);
    }

    public function update(Request $request, int $id)
    {
        $post = Post::find($id);
        if($post)
        {
            $post->fill($request->all());
            $post->save();            
            return new PostResource($post);
        }
        else
        {
            return response()->json('Post inexistente', 204);
        }

    }

    public function destroy(int $id)
    {
        $post = Post::find($id);
        if($post)
        {
            Post::destroy($id);
            return response()->json('Usuário excluído com sucesso!', 204);
        }
        else
        
        {
            return response()->json('Usuário inexistente', 404);
        }
    }

    // actions relationship: comments

    public function getComments(int $post_id)
    {
        $postComments = Post::find($post_id)->Comments;
        if($postComments)
        {
            return CommentResource::collection($postComments);
            return response()->json($postComments, 201);
        }
        else
        {
            return response()
            ->json('Esse post não possui comentários', 204);
        }
    }
}