<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerificationResendController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->noContent();
    }
}
