<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;

class EmailVerificationNotificationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth', 'throttle:6,1'];
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->noContent();
    }
}
