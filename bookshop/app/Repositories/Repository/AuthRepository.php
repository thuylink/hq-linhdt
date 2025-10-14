<?php

namespace App\Repositories\Repository;

use App\Models\Admin;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
    public function register(array $data)
    {
        $admin = new Admin();
        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->save();
        $token = $admin->createToken($data['email'])->plainTextToken;
        return [$admin, $token];
    }
    public function login(array $data)
    {
        $admin = Admin::where('email', $data['email'])->firstOrFail();
        if ($admin && Hash::check($data['password'], $admin->password)) {
            $token = $admin->createToken($admin->id)->plainTextToken;
            return [$admin, $token];
        }
        return null;
    }
    public function logged() {}
    public function logout() {}
}
