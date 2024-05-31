<?php 
namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Builder;

class PostService
{
    public function index($request)
    {
        $query = Post::query();

        if($search = $request->input('search')){
            $query->where('title', 'like', $search.'%');
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

    public function show($id){
        $show = Post::where('id', $id)->first();
        if ( !$show ) throw ValidationException::withMessages([
            'data' => ['Data not found.'],
        ]); 
        return $show;
    }

    public function store($request)
    {
        $me = User::findOrFail(Auth::User()->id);
        
        $request['user_id'] = $me->id;
        $store = Post::create($request);

        if(isset($request['image'])){
            $files = $request['image']; 

            foreach ($files as $key => $file) {  
                $extension = $file->getClientOriginalExtension();
                $imageName = 'image'.$key.'-'.time().'-'.str_replace(' ', '', Auth::user()->name).'.'.$extension;
                $path = $file->storeAs('public/posts', $imageName);

                $store_file = new Image;
                $store_file->post_id = $store->id;
                $store_file->image = $imageName;
                $store_file->path = $path;
                $store_file->save();
            }
        }

        return $store;
    }   

    public function update($request, $id)
    {  
        $post = Post::where('id', $id)->first();

        if (!$post) throw ValidationException::withMessages([
            'data' => ['Data not found!'],
        ]); 

        if(isset($request['image'])){
            $files = $request['image']; 

            if ($post->images != null) {
                foreach ($post->images as $image) {
                    // hapus storage 
                    Storage::disk('public')->delete('posts/' . $image->image);
                    
                    // hapus row image 
                    $image = Image::findOrFail($image->id);
                    $image->delete();
                }
            }

            foreach ($files as $key => $file) {  
                $extension = $file->getClientOriginalExtension();
                $imageName = 'image'.$key.'-'.time().'-'.str_replace(' ', '', Auth::user()->name).'.'.$extension;
                $path = $file->storeAs('public/posts', $imageName);

                $store_file = new Image;
                $store_file->post_id = $post->id;
                $store_file->image = $imageName;
                $store_file->path = $path;
                $store_file->save();
            }
        }

        $post->update($request);
        return $post;
    }

    public function destroy($id)
    {
        $destroy = Post::where('id', $id)->first();
        if ( !$destroy ) throw ValidationException::withMessages([
            'data' => ['Data not found!'],
        ]); 
        $destroy->destroy($id);
        return $destroy;
    }   
}   
?>