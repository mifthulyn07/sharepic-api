<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\API\User\UpdateUserRequest;


class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $response = $this->service->index($request);
            return $this->successResp('Berhasil mendapatkan data!', new UserCollection($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function me()
    {
        try {
            $response = $this->service->me();
            return $this->successResp('Successfully retrieved data!', new UserResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        try {
            $response = $this->service->updateProfile($request->validated());
            return $this->successResp('Updated successfully!.', new UserResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function show($id)
    {
        try {
            $response = $this->service->show($id);
            return $this->successResp('Berhasil mendapatkan data!', new UserResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }
}
