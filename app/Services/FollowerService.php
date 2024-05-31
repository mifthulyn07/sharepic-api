<?php 
namespace App\Services;

use App\Repositories\FollowerRepository;

class FollowerService
{
    protected $followerRepository;

    public function __construct(FollowerRepository $followerRepository)
    {
        $this->followerRepository = $followerRepository;
    }

    public function follow($request)
    {
        return $this->followerRepository->follow($request);
    }  

    public function unfollow($user_id)
    {
        return $this->followerRepository->unfollow($user_id);
    }      

    public function followers($request)
    {
        return $this->followerRepository->followers($request);
    }

    public function following($request)
    {
        return $this->followerRepository->following($request);
    }

}
?>