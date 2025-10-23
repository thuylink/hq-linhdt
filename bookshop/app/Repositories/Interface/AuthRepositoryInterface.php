<?php

namespace App\Repositories\Interface;

interface AuthRepositoryInterface
{
    
    public function register(array $data);
    public function login(array $data);
    public function logged();
    public function logout();
}
