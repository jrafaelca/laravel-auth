<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AuthenticatedUserResource;
use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    public function __invoke(Request $request): AuthenticatedUserResource
    {
        return AuthenticatedUserResource::make($request->user());
    }
}
