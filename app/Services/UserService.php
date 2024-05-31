<?php 
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($request)
    {
        return $this->userRepository->index($request);
    }

    public function me()
    {
        return $this->userRepository->me();
    }

    public function updateProfile($request)
    {
        return $this->userRepository->updateProfile($request);
    }

    public function show($id)
    {
        return $this->userRepository->show($id);
    }
}
?>