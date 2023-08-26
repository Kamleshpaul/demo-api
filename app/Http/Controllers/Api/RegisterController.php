<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Login Api.
     */
    public function __invoke(Request $request)
    {
        $input = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ]);

        $user = User::create($input);

        return ApiResponse::success($user);
    }
}
