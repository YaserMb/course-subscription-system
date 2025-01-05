<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function downloadHistories()
    {
        return $this->hasMany(DownloadHistory::class);
    }
}
