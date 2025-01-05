<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $isAdmin = $request->query('admin', false);
        return view('auth.login', compact('isAdmin'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if ($request->has('admin')) {
            if (!Auth::user()->is_admin) {
                Auth::logout();
                return redirect()->route('login', ['admin' => 1])
                    ->withErrors(['email' => 'These credentials do not have admin access.']);
            }
            return redirect()->intended(route('admin.dashboard'));
        }

        // Regular user login
        if (empty(Auth::user()->subscription_plan_id)) {
            return redirect()->route('subscription-plans.plans');
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
