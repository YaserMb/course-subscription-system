@props(['course', 'isDownloaded'])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h4 class="text-xl font-semibold mb-2">{{ $course->name }}</h4>
        <p class="text-gray-600 mb-4">{{ $course->description }}</p>

        @if($isDownloaded)
            <span class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Downloaded
            </span>
        @else
            @if(auth()->user()->subscription_plan_id)
                <button
                    type="button"
                    class="download-btn inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    data-course-id="{{ $course->id }}"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Download</span>
                </button>
            @else
                <a href="{{ route('subscription-plans.plans') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Subscribe to Download
                </a>
            @endif
        @endif
    </div>
</div>
