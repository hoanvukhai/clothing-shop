<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $redirectUrl = route('home', absolute: false);
        if ($request->user()->role === 'admin') {
            $redirectUrl = route('admin.dashboard', absolute: false);
        }

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended($redirectUrl)
                    : view('auth.verify-email');
    }
}
