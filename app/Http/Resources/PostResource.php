<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function __construct($resource)
    {
        parent::__construct($resource);
    }
    public function toArray($request)
    {
        $total = $this->resource->count();

        $data = $this->resource->map(function ($post) {
            return [
                'id' => $post->id,
                'name' => $post->name,
                'price' => $post->price,
                'description' => $post->description,
                'links' => ['self' => url('posts/' . $post->id)]
            ];
        })->take(5);

        return [
            'total' => $total,
            'retrieved' => $data->count(),
            'data' => $data
        ];
    }
}
