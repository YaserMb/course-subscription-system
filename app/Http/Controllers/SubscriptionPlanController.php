<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::all();
        return view('subscription-plans.index', compact('plans'));
    }

    public function plans()
    {
        $plans = SubscriptionPlan::all();
        return view('subscription-plans.plans', compact('plans'));
    }

    public function create()
    {
        return view('subscription-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'limit' => 'required|integer|min:0',
        ]);

        SubscriptionPlan::create($validated);

        return redirect()->route('subscription-plans.index')
            ->with('success', 'Subscription plan created successfully.');
    }

    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return view('subscription-plans.edit', compact('subscriptionPlan'));
    }

    public function update(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'limit' => 'required|integer|min:0',
        ]);

        $subscriptionPlan->update($validated);

        return redirect()->route('subscription-plans.index')
            ->with('success', 'Subscription plan updated successfully.');
    }

    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();

        return redirect()->route('subscription-plans.index')
            ->with('success', 'Subscription plan deleted successfully.');
    }

    public function subscribe(SubscriptionPlan $subscriptionPlan)
    {
        $user = auth()->user();
        $user->subscription_plan_id = $subscriptionPlan->id;
        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Successfully subscribed to ' . $subscriptionPlan->name);
    }
}
