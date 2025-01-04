<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'url'];

    public function downloadHistories()
    {
        return $this->hasMany(DownloadHistory::class);
    }
}
