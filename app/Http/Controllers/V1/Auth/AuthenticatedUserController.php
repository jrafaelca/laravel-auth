<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Auth\AuthenticatedUserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class AuthenticatedUserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return ['auth'];
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): AuthenticatedUserResource
    {
        return AuthenticatedUserResource::make($request->user());
    }
}
