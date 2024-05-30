<?php

namespace App\Http\Controllers\Api;

use App\Services\FollowerService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Follower\FollowResource;
use App\Http\Requests\API\Follower\FollowRequest;
use App\Http\Resources\Follower\FollowersResource;
use App\Http\Resources\Follower\FollowingResource;

class FollowerController extends Controller
{
    protected $service;

    public function __construct(FollowerService $service)
    {
        $this->service = $service;
    }

    public function follow(FollowRequest $request)
    {
        try {
            $response = $this->service->follow($request->validated());
            return $this->successResp('Follow successfully!.', new FollowersResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function unfollow($user_id)
    {
        try {
            $response = $this->service->unfollow($user_id);
            return $this->successResp('Unfollow successfully!.', $response);
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }
}
