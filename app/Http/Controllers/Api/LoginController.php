<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        $user = User::where('email',$input['email'])->first();
        if (!$user) {
            return ApiResponse::failed('No User Found.');
        }

        if(!Hash::check($input['password'],$user->password)){
            return ApiResponse::failed('Password not found.');
        }

        $token = $user->createToken($user->name);
        return ApiResponse::success([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
}
