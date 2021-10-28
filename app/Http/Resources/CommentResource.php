<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => [
                'name' => $this->user->name,
                'user' => $this->user->user
            ],
            'comment' => $this->comment,
            'post' => [
               'title' => $this->post->title,
               'content' => $this->post->content,
               'author' => [
                   'user' => $this->post->user->user,
                   'name' => $this->post->user->name,  
               ],
            ],
        ];
    }
}