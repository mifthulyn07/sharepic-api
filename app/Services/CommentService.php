<?php 
namespace App\Services;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CommentService
{
    public function index($request)
    {
        $query = User::query();

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

    public function store($request)
    {
        $me = User::findOrFail(Auth::User()->id); 
        $request['user_id'] = $me->id;

        $store = Comment::create($request);
        return $store;
    }   

    public function destroy($id)
    {
        $destroy = Comment::where('id', $id)->first();
        if ( !$destroy ) throw ValidationException::withMessages([
            'data' => ['Data not found!'],
        ]); 
        $destroy->destroy($id);
        return $destroy;
    }  
}
?>