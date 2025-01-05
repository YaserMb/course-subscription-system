<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && empty(Auth::user()->subscription_plan_id) || Auth::user()->subscription_plan_id == null && !Auth::user()->is_admin) {
            return redirect()->route('subscription-plans.plans');
        }

        return $next($request);
    }
}
