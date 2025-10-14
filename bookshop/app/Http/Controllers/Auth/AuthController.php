<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $registerRequest)
    {
        $admin = $this->authService->register($registerRequest->only('name', 'email', 'password'));
        return response()->json([
            'message' => 'Registered',
            'useadminr' => $admin
        ], Response::HTTP_OK);
    }

    public function login(LoginRequest $loginRequest)
    {
        $adminResult = $this->authService->login($loginRequest->only('email', 'password'));
        return response()->json([
            'meassage' => 'Logged in',
            'result' => $adminResult
        ], Response::HTTP_OK);
    }

    public function logged()
    {
        $loggedAdmin = Auth::user();
        return response()->json([
            'message' => 'This admin is logging in',
            'loggedUser' => $loggedAdmin
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }
}
