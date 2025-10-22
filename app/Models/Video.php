<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_path'
    ];

    public function requests()
    {
        return $this->hasMany(VideoRequest::class);
    }

    public function accesses()
    {
        return $this->hasMany(VideoAccess::class);
    }
}
