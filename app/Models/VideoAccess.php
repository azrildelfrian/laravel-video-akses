<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoAccess extends Model
{
    use HasFactory;
    protected $table = 'video_access';

    protected $fillable = [
        'user_id',
        'video_id',
        'start_time',
        'end_time',
        'active'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function getIsActiveAttribute()
    {
        return $this->end_time->isFuture();
    }
}
