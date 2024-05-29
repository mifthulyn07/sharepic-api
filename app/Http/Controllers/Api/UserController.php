<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // protected $service;

    // public function __construct(UserService $service)
    // {
    //     $this->service = $service;
    // }

    // public function index()
    // {
    //     try {
    //         $response = $this->service->index($request);
    //         return $this->successResp('Berhasil mendapatkan data!', new UserCollection($response));
    //     } catch (ValidationException $th) {
    //         return $this->errorResp($th->errors());
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
