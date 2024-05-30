<?php 
namespace App\Services;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class FollowerService
{
    public function follow($request)
    {
        $me = User::findOrFail(Auth::User()->id);
        $request['follower_id'] = $me->id;
        $follow = Follower::create($request);
        return $follow;
    }  

    public function unfollow($user_id)
    {
        $me = User::findOrFail(Auth::User()->id);
        $following = $me->following()->where('user_id', $user_id)->first();
        if(!$following){
            throw ValidationException::withMessages([
                'data' => ['Data not found!'],
            ]); 
        }
        $following->delete();
        return $following;
    }      
}
?>