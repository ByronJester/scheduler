<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'start_time',
        'end_time',
        'class'
    ];

    protected $appends = [
        'teacher'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTeacherAttribute()
    {
        return $this->user->name;
    }
}
