<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadHistory extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
