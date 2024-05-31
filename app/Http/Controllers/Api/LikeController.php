<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\LikeService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Like\LikeResource;
use App\Http\Requests\API\Like\LikeRequest;
use App\Http\Resources\Like\LikeCollection;
use Illuminate\Validation\ValidationException;

class LikeController extends Controller
{
    protected $service;

    public function __construct(LikeService $service)
    {
        $this->service = $service;
    }

    public function likes(Request $request){
        try {
            $response = $this->service->likes($request);
            return $this->successResp('Successfully retrieved data!', new LikeCollection($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function like(LikeRequest $request)
    {
        try {
            $response = $this->service->like($request->validated());
            return $this->successResp('Like successfully!.', new LikeResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function unlike($post_id)
    {
        try {
            $response = $this->service->unlike($post_id);
            return $this->successResp('Unlike successfully!.', $response);
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }
}
