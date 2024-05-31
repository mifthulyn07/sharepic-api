<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,  
            'user_id' => $this->user_id,
            'user' => $this->user,
            'post_id' => $this->post_id,
            'post' => $this->post,
            'comment' => $this->comment,
        ];
    }
}
