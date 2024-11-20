<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return ['auth'];
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return response()->noContent();
    }
}
