<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'get' => 'api/comment',
                'getSpecific' => 'api/comment/{id}',
                'create' => 'api/comment/store',
                'edit' => 'api/comment/edit/{id}',
                'delete' => 'api/comment/delete/{id}'
            ],
        ];
    }
}