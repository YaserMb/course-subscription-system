<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'description' => 'Access to basic courses with limited downloads',
                'price' => 9.99,
                'limit' => 10,
            ],
            [
                'name' => 'Standard Plan',
                'description' => 'Access to all courses with moderate downloads',
                'price' => 19.99,
                'limit' => 20,
            ],
            [
                'name' => 'Premium Plan',
                'description' => 'Unlimited access to all courses and downloads',
                'price' => 29.99,
                'limit' => 50,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }
    }
}
