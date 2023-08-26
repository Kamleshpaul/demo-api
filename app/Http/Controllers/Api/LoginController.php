<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    /**
     * Login Api.
     */
    public function __invoke(Request $request)
    {
        $input = $request->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ]);

        $user = User::where($input)->first();
        if (!$user) {
            return ApiResponse::failed('No User Found.');
        }

        $token = $user->createToken($user->name);
        return ApiResponse::success([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
}
