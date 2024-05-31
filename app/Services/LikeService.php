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

    public function likes($request)
    {
        $query = Like::query()->where('user_id', auth()->user()->id);

        if($search = $request->input('search')){
            $query->where('name', 'like', $search.'%')
            ->orWhere('email', 'like',$search.'%');
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