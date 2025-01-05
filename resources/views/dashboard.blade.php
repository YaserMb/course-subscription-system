<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Add meta tag for CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->subscription_plan_id != null)
                        <div class="mb-4">
                            <h3 class="text-lg font-medium">Current Subscription Details</h3>
                            <p class="mt-2">Plan: {{ $subscriptionPlan->name }}</p>
                            <p>Current Download Limit: {{ $subscriptionPlan->limit }}</p>
                            <p>Download Limit Used: {{ $subscriptionPlan->downloaded }}</p>
                        </div>
                    @else
                        <div class="mb-4">
                            <p>You currently don't have an active subscription.</p>
                            <a href="{{ route('subscription-plans.plans') }}" class="text-blue-600 hover:text-blue-800">View available plans</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-course-section
        :courses="$allCourses"
        :downloadedCourses="$downloadedCourses"
    />
</x-app-layout>
