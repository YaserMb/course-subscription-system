<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $subscriptionPlan = $user->subscriptionPlan;
        $downloadedCourses = $user->downloadHistories()->pluck('course_id');
        $allCourses = Course::all();

        // Get higher tier plans if user has a subscription
        $hasHigherTierPlan = false;
        if ($subscriptionPlan) {
            $hasHigherTierPlan = SubscriptionPlan::where('limit', '>', $subscriptionPlan->limit)->exists();
        }

        return view('dashboard', [
            'subscriptionPlan' => $subscriptionPlan,
            'downloadedCourses' => $downloadedCourses,
            'allCourses' => $allCourses,
            'hasHigherTierPlan' => $hasHigherTierPlan,
        ]);
    }
}

