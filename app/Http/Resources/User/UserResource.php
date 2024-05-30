<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Follower\FollowersResource;
use App\Http\Resources\Follower\FollowingResource;

class UserResource extends JsonResource
{


    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,  
            'name' => $this->name,
            'gender' => $this->gender,
            'birth' => $this->birth,
            'profile_picture' => $this->profile_picture,
            'bio' => $this->bio,
            'followers' => FollowersResource::collection($this->followers),
            'following' => FollowingResource::collection($this->following),
            'posts' => PostResource::collection($this->posts),
        ];
    }
}
