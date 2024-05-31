<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\API\Comment\StoreCommentRequest;

class CommentController extends Controller
{
    protected $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function store(StoreCommentRequest $request)
    {
        try {
            $response = $this->service->store($request->validated());
            return $this->successResp('Successfully added comment!', new CommentResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->service->destroy($id);
            return $this->successResp('Successfully deleted comment!', $response);
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }
}
