<?php

namespace App\Http\Controllers\Api;

use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\API\Post\CreatePostRequest;
use App\Http\Requests\API\Post\UpdatePostRequest;


class PostController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // try {
        //     $response = $this->service->index($request);
        //     return $this->successResp('Berhasil mendapatkan data!', new UserCollection($response));
        // } catch (ValidationException $th) {
        //     return $this->errorResp($th->errors());
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(CreatePostRequest $request)
    {
        try {
            $response = $this->service->store($request->validated());
            return $this->successResp('Successfully added post!', new PostResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // try {
        //     $response = $this->service->show($id);
        //     return $this->successResp('Berhasil mendapatkan data!', new UserResource($response));
        // } catch (ValidationException $th) {
        //     return $this->errorResp($th->errors());
        // }
    }

    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $response = $this->service->update($request->validated(), $id);
            return $this->successResp('Succesfully updated post!', new PostResource($response));
        } catch (ValidationException $th) {
            return $this->errorResp($th->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // try {
        //     $response = $this->service->destroy($id);
        //     return $this->successResp('Berhasil menghapus user!', $response);
        // } catch (ValidationException $th) {
        //     return $this->errorResp($th->errors());
        // }
    }
}
