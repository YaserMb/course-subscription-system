<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\DownloadHistory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalDownloads = DownloadHistory::count();
        $users = User::with(['downloadHistories'])
            ->select('id', 'name', 'email', 'subscription_plan_id')
            ->where('is_admin', false)
            ->withCount('downloadHistories')
            ->latest()
            ->take(3)
            ->get();

        $totalUsers = $users->count();
        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'totalDownloads', 'users'));
    }

    public function users()
    {
        $users = User::with(['subscriptionPlan', 'downloadHistories'])
            ->select('id', 'name', 'email', 'subscription_plan_id', 'created_at')
            ->where('is_admin', false)
            ->withCount('downloadHistories')
            ->latest()
            ->paginate(10);

        return view('admin.users', compact('users'));
    }
}
