<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{


    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,  
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender,
            'birth' => $this->birth,
            'profile_picture' => $this->profile_picture,
            'bio' => $this->bio,
        ];
    }
}
