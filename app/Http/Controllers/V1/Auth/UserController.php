<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Auth\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request): UserResource
    {
        return UserResource::make($request->user());
    }
}
