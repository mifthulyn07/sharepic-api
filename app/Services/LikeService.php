<?php 
namespace App\Services;

use App\Models\Like;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LikeService
{
    public function like($request)
    {
        $me = User::findOrFail(Auth::User()->id);
        $request['user_id'] = $me->id;
        $like = Like::create($request);
        return $like;
    }  

    public function unlike($post_id)
    {
        $me = User::findOrFail(Auth::User()->id);
        $like = $me->likes()->where('post_id', $post_id)->first();
        if(!$like){
            throw ValidationException::withMessages([
                'data' => ['Data not found!'],
            ]); 
        }
        $like->delete();
        return $like;
    }      
}
?>