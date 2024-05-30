<?php 
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class UserService
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

    public function me()
    {
        $me = Auth::User();
        return $me;
    }

    public function updateProfile($request)
    {
        $me = User::findOrFail(Auth::User()->id);

        if(!$me){
            throw ValidationException::withMessages([
                'data' => ['Data not found!'],
            ]); 
        }

        if(isset($request['profile_picture'])){
            if ($me->profile_picture) {
                Storage::disk('public')->delete('profile-picture/' . $me->profile_picture);
            }

            $extension = $request['profile_picture']->getClientOriginalExtension();//mime:jpg,png,dll
            $imageName = time().'-'.str_replace(' ', '', Auth::user()->name).'.'.$extension;
            $request['profile_picture']->storeAs('public/profile-picture', $imageName);
            $request['profile_picture'] = $imageName;
        }

        $me->update($request);
        return $me;
    }

    public function show($id){
        $show = User::findOrFail($id);
        if ( !$show ) throw ValidationException::withMessages([
            'data' => ['Data tidak ditemukan.'],
        ]); 
        return $show;
    }
}
?>