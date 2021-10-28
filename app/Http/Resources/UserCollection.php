<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'get' => 'api/user',
                'getSpecific' => 'api/user/{id}',
                'create' => 'api/user/store',
                'edit' => 'api/user/edit/{id}',
                'delete' => 'api/user/delete/{id}'
            ],
        ];
    }
}