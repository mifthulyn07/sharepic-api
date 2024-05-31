<?php 
namespace App\Services;

use App\Repositories\LikeRepository;



class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function like($request)
    {
        return $this->likeRepository->like($request);
    }  

    public function unlike($post_id)
    {
        return $this->likeRepository->unlike($post_id);
    }      

    public function likes($request)
    {
        return $this->likeRepository->likes($request);
    }
}
?>