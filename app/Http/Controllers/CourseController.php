<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DownloadHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        if ($user->downloadHistories()->where('course_id', $course->id)->exists()) {
            // Generate download URL for already downloaded course
            $downloadHistory = $user->downloadHistories()->where('course_id', $course->id)->first();
            $downloadUrl = route('courses.download.file', ['course' => $course->id, 'token' => $downloadHistory->download_token]);

            return response()->json([
                'success' => true,
                'message' => 'Course already downloaded.',
                'download_url' => $downloadUrl
            ]);
        }

        // Get user's subscription plan and check download limit
        $subscriptionPlan = $user->subscriptionPlan;
        $downloadedCount = $user->downloadHistories()->count();
        if ($downloadedCount >= $subscriptionPlan->limit) {
            return response()->json([
                'success' => false,
                'message' => 'You have reached your subscription limit. Please upgrade your plan to download more courses.'
            ], 403);
        }

        try {
            // Generate a unique download token
            $downloadToken = Str::random(64);

            $user->downloadHistories()->create([
                'course_id' => $course->id,
                'downloaded_at' => now(),
                'download_token' => $downloadToken
            ]);

            $downloadUrl = route('courses.download.file', ['course' => $course->id, 'token' => $downloadToken]);

            return response()->json([
                'success' => true,
                'message' => 'Course downloaded successfully.',
                'download_url' => $downloadUrl
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while downloading the course.'
            ], 500);
        }
    }

    public function downloadFile(Request $request, Course $course, $token)
    {
        $user = Auth::user();

        // Verify the download token
        $downloadHistory = DownloadHistory::where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->where('download_token', $token)
            ->first();

        if (!$downloadHistory) {
            abort(403, 'Invalid or expired download token.');
        }

        // Check if the file exists
        if (!Storage::exists($course->file_path)) {
            abort(404, 'Course file not found.');
        }

        // Get the file mime type
        $mimeType = Storage::mimeType($course->file_path);

        // Return the file as a download
        return Storage::download($course->file_path, basename($course->file_path), [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }
}
