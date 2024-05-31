<?php

namespace App\Http\Resources\Follower;

use Illuminate\Http\Request;
use App\Http\Resources\Follower\FollowingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FollowingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meta' => [
            "total" => $this->total(), 
            "per_page" => $this->perPage(),
            "count_items" => $this->count(),
            "current_page" => $this->currentPage(),
            "last_page" => $this->lastPage(),
            "from" => $this->firstItem(),
            "to" => $this->lastItem(),
            ],
            'list' => FollowingResource::collection($this->collection),
        ];
    }
}
