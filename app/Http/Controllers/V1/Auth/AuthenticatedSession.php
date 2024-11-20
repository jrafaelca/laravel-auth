<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSession extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['guest', 'throttle:3,1'];
    }

    /**
     * Handle the incoming request.
     *
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): Response
    {

        $credentials = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password')
        ];

        if (!Auth::attempt($credentials, $request->validated('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return response()->noContent();
    }
}
