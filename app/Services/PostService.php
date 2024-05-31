<?php 
namespace App\Services;

use App\Repositories\PostRepository;



class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index($request)
    {
        return $this->postRepository->index($request);
    }

    public function show($id)
    {
        return $this->postRepository->show($id);
    }

    public function store($request)
    {
        return $this->postRepository->store($request);
    }   

    public function update($request, $id)
    {  
        return $this->postRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->postRepository->destroy($id);
    }   
}   
?>