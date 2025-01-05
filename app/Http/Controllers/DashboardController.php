<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\DownloadHistory;
use App\Models\SubscriptionPlan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $allCourses = Course::all();
        $subscriptionPlan = SubscriptionPlan::find($user->subscription_plan_id);
        $downloadedCourses = $user->courses()->pluck('courses.id');
        return view('dashboard', compact('allCourses', 'downloadedCourses', 'subscriptionPlan'));
    }
}
