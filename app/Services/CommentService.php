<?php 
namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index($request)
    {
        return $this->commentRepository->index($request);
    }

    public function store($request)
    {
        return $this->commentRepository->store($request);
    }   

    public function destroy($id)
    {
        return $this->commentRepository->destroy($id);
    }  
}
?>