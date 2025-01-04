<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = ['name', 'description', 'price', 'limit'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
