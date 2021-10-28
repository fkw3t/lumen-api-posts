<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'author' => [
                'user' => $this->user->user,
                'name' => $this->user->name,  
            ],
            'links' => [
                'comments' => '/api/post/' . $this->id . '/comment',
            ]
        ];
    }
}