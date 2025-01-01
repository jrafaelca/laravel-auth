<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Response;

class VerificationController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): Response
    {
        $request->fulfill();

        return response()->noContent();
    }
}
