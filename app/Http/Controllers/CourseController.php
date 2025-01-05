<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function download(Course $course)
    {
        $user = Auth::user();

        // Check if user has an active subscription
        if (!$user->subscription_plan_id) {
            return response()->json([
                'success' => false,
                'message' => 'Please subscribe to a plan to download courses.'
            ], 403);
        }

        // Check if user has already downloaded this course
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'You have already downloaded this course.'
            ], 400);
        }

        // Get user's subscription plan and check download limit
        $subscriptionPlan = $user->subscriptionPlan;
        $downloadedCount = $user->courses()->count();
        if ($downloadedCount >= $subscriptionPlan->limit) {
            return response()->json([
                'success' => false,
                'message' => 'You have reached your subscription limit. Please upgrade your plan to download more courses.'
            ], 403);
        }

        try {
            $user->downloadHistories()->create([
                'course_id' => $course->id,
                'downloaded_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Course downloaded successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while downloading the course.'
            ], 500);
        }
    }
}
