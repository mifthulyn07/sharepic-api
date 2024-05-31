<?php 
namespace App\Services;

use App\Repositories\AuthRepository;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($request)
    {    
        return $this->authRepository->login($request); 
    }

    public function register($request)
    {
        return $this->authRepository->register($request); 
    }   

    public function logout($request)
    {
        return $this->authRepository->logout($request); 
    }
}
?>