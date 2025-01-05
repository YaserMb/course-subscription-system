<?php

namespace App\Http\Middleware;

use App\Models\DownloadHistory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyDownloadToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');
        $token = $request->route('token');
        $user = Auth::user();

        $downloadHistory = DownloadHistory::where([
            'course_id' => $course->id,
            'user_id' => $user->id,
            'download_token' => $token,
        ])->first();

        if (!$downloadHistory) {
            abort(403, 'Invalid or expired download token.');
        }

        return $next($request);
    }
}
