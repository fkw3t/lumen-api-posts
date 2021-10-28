<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'get' => 'api/post',
                'getSpecific' => 'api/post/{id}',
                'create' => 'api/post/store',
                'edit' => 'api/post/edit/{id}',
                'delete' => 'api/post/delete/{id}'
            ],
        ];
    }
}