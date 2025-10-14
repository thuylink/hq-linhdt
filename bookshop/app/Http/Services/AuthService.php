<?php

namespace App\Http\Services;

use App\Repositories\Interface\AuthRepositoryInterface;
use Illuminate\Auth\Events\Registered;

class AuthService
{
    public function __construct(
        protected AuthRepositoryInterface $authRepositoryInterface
    ) {}
    public function register(array $data)
    {
        [$admin, $token] = $this->authRepositoryInterface->register($data);
        event(new Registered($admin));
        return $token;
    }
    public function login(array $data)
    {
        $adminLogin = $this->authRepositoryInterface->login($data);
        if ($adminLogin) {
            [$admin, $token] = $adminLogin;
            return [$admin, $token];
        }

        return [
            'message' => 'Login failed',
        ];
    }
}
