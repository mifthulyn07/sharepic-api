<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Requests\API\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\API\User\StoreUserRequest;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        try {
            $response = $this->service->login($request);
            return $this->successResp('Login successfully!', new AuthResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function register(StoreUserRequest $request)
    {
        try {
            $response = $this->service->register($request->validated());
            return $this->successResp('Register successfully!.', new AuthResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    public function logout(Request $request)
    {
        try {
            $response = $this->service->logout($request);
            return $this->successResp('Logout successfully!', $response);
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }
}