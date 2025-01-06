<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription Plans') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Choose Your Subscription Plan</h2>

            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($plans as $plan)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $plan->name }}</h3>
                            <div class="text-3xl font-bold mb-4">${{ number_format($plan->price, 2) }}</div>
                            <p class="text-gray-600 mb-4">{{ $plan->description }}</p>
                            <div class="mb-6">
                                <div class="flex items-center mb-2">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ $plan->limit }} Downloads per month</span>
                                </div>
                            </div>

                            @if(auth()->user()?->subscription_plan_id == $plan->id)
                                <button class="w-full justify-center bg-gray-300 text-gray-700 px-4 py-2 rounded-md cursor-not-allowed opacity-75" disabled>
                                    Current Plan
                                </button>
                            @else
                                <form action="{{ route('subscription-plans.subscribe', $plan) }}" method="POST">
                                    @csrf
                                    <x-primary-button class="w-full justify-center">
                                        Subscribe Now
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
