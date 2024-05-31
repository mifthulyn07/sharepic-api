<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FollowerService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\API\Follower\FollowRequest;
use App\Http\Resources\Follower\FollowersResource;
use App\Http\Resources\Follower\FollowingResource;
use App\Http\Resources\Follower\FollowersCollection;
use App\Http\Resources\Follower\FollowingCollection;

class FollowerController extends Controller
{
    protected $service;

    public function __construct(FollowerService $service)
    {
        $this->service = $service;
    }

    public function followers(Request $request){
        try {
            $response = $this->service->followers($request);
            return $this->successResp('Successfully retrieved data!', new FollowersCollection($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function following(Request $request){
        try {
            $response = $this->service->following($request);
            return $this->successResp('Successfully retrieved data!', new FollowingCollection($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function follow(FollowRequest $request)
    {
        try {
            $response = $this->service->follow($request->validated());
            return $this->successResp('Follow successfully!.', new FollowingResource($response));
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
