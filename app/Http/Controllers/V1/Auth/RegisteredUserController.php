<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['guest'];
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request): Response
    {
        $user = User::query()
            ->create([
                'name' => $request->validated('name'),
                'email' => $request->validated('email'),
                'password' => Hash::make($request->string('password')),
            ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
