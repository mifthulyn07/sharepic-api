<?php 
namespace App\Repositories;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class FollowerRepository
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

    public function followers($request)
    {
        $query = Follower::query()->where('user_id', auth()->user()->id);

        if($search = $request->input('search')){
            $query->WhereHas('follower', function(Builder $query) use ($search) {
                $query->where('name', 'like', $search.'%')
                ->orWhere('email', 'like', $search.'%');
            });
        }

        if($request->has('order') && $request->order && $request->has('sort') && $request->sort){
            $query->orderBy($request->order, $request->sort);
        }

        if ($request->has('limit')) {
                $list = $query->paginate( $request['limit'] );
            } else {
                $list = $query->paginate(10);
        }

        return $list;
    }

    public function following($request)
    {
        $query = Follower::query()->where('follower_id', auth()->user()->id);

        if($search = $request->input('search')){
            $query->WhereHas('user', function(Builder $query) use ($search) {
                $query->where('name', 'like', $search.'%')
                ->orWhere('email', 'like', $search.'%');
            });
        }

        if($request->has('order') && $request->order && $request->has('sort') && $request->sort){
            $query->orderBy($request->order, $request->sort);
        }

        if ($request->has('limit')) {
                $list = $query->paginate( $request['limit'] );
            } else {
                $list = $query->paginate(10);
        }

        return $list;
    }

}
?>