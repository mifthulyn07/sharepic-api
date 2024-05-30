<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Follower\FollowingResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'user_id' => $this->user_id,
            'user' => $this->user,
            'following' => $this->user->following,
            'title' => $this->title,
            'body' => $this->body,
            'images' => $this->images,
        ];
    }
}
