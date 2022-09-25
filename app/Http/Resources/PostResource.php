<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as JsonJsonResource;


class PostResource extends JsonJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
        ];
    }
}
