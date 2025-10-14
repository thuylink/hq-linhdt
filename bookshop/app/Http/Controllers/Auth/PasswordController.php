<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class PasswordController extends Controller
{
    public function sendLinkReserEmail(Request $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? response()->json(
                [
                    'message' => 'Sent email'
                ],
                Response::HTTP_OK
            )
            : response()->json([
                'message' => 'Sent mail failed'
            ], Response::HTTP_BAD_REQUEST);
    }
}
