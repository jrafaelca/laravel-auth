<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;

class EmailVerifyController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth', 'signed'];
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(EmailVerificationRequest $request): Response
    {
        $request->fulfill();

        return response()->noContent();
    }
}
