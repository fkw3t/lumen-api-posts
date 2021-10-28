<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $posts = Post::where('user_id', $this->id)->get();

        foreach ($posts as $post){
            $postLinks[] = '/api/post/' . $post->id;
        }

        $comments = Comment::where('user_id', $this->id)->get();

        foreach ($comments as $comment){
            $commentLinks[] = '/api/comment/' . $comment->id;
        }

        return [
            'userType' => $this->when($this->is_admin, fn() => 'admin'),
            'name' => $this->name,
            'user' => $this->user,
            'email' => $this->email,
            'links' => [
                'posts' => $postLinks,
                'comments' => $commentLinks,
            ],
        ];
    }
}