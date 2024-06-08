<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FollowerController;



// register 
Route::post('/register', [AuthController::class, 'register']);
// login 
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    // update profile 
    Route::post('/profile', [UserController::class, 'updateProfile']);
    // get my profile + followers & following
    Route::get('/me', [UserController::class, 'me']);
    // search user by name + followers & following
    Route::get('user/', [UserController::class, 'index']);
    // get other user profile + followers & following
    Route::get('/user/{id}', [UserController::class, 'show']);
    // logout 
    Route::post('/logout', [AuthController::class, 'logout']);

    // get followers
    Route::get('/followers', [FollowerController::class, 'followers']);
    // get following
    Route::get('/following', [FollowerController::class, 'following']);
    // follow user
    Route::post('/follow', [FollowerController::class, 'follow']);
    // unfollow user
    Route::delete('/unfollow/{user_id}', [FollowerController::class, 'unfollow']);

    // add post
    Route::post('/post', [PostController::class, 'store']);
    // edit post
    Route::post('/post/{id}', [PostController::class, 'update']);
    // get all posts
    Route::get('post/', [PostController::class, 'index']);
    // get spesific post(by id)
    Route::get('/post/{id}', [PostController::class, 'show']);
    // delete post 
    Route::delete('/post/{id}', [PostController::class, 'destroy']);

    // like post
    Route::post('/like', [LikeController::class, 'like']);
    // unlike post
    Route::delete('/unlike/{post_id}', [LikeController::class, 'unlike']);
    // get my liked post
    Route::get('likes/', [LikeController::class, 'likes']);

    // add comment (only text)
    Route::post('/comment', [CommentController::class, 'store']);
    // delete comment
    Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
});
