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
                            <p>Current Download Limit: {{ $subscriptionPlan->limit }}
                                @if($hasHigherTierPlan)
                                    <a href="{{ route('subscription-plans.plans') }}" class="text-blue-600 hover:text-blue-800 ml-2">
                                        (upgrade plan to increase download limit)
                                    </a>
                                @endif
                            </p>
                            <div class="mt-4">
                                <div class="flex items-center justify-between mb-2">
                                    <p class="flex items-center">
                                        Download Limit Used: <span id="download-count" class="ml-1">{{ $downloadedCourses->count() }}</span>
                                        <span class="mx-1">/</span>
                                        <span id="download-limit">{{ $subscriptionPlan->limit }}</span>
                                    </p>
                                    <div id="upgrade-button-container" class="@if($downloadedCourses->count() < $subscriptionPlan->limit) hidden @endif">
                                        <a href="{{ route('subscription-plans.plans') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors">
                                            Upgrade Plan
                                        </a>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div id="download-progress" class="bg-blue-600 h-2.5 rounded-full transition-all duration-300" style="width: {{ ($downloadedCourses->count() / $subscriptionPlan->limit) * 100 }}%"></div>
                                </div>
                            </div>
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                <div class=" text-gray-900">
                    <h3 class="text-lg font-medium">All Courses</h3>
                    <x-course-section
                        :courses="$allCourses"
                        :downloadedCourses="$downloadedCourses"
                    />
                </div>
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
