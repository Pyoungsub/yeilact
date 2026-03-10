<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function purposes()
    {
        return $this->hasMany(Purpose::class);
    }
    public function mainpage_lesson_photos()
    {
        return $this->hasMany(MainpageLessonPhoto::class);
    }
    public function lesson_youtube()
    {
        return $this->hasOne(LessonYoutube::class);
    }
    public function lesson_tuition_photos()
    {
        return $this->hasMany(LessonTuitionPhoto::class)->latest();
    }
    public function lesson_tuition_youtubes()
    {
        return $this->hasMany(LessonTuitionYoutube::class);
    }
    public function lesson_main_video()
    {
        return $this->hasOne(LessonMainVideo::class);
    }
    public function lesson_tuition_videos()
    {
        return $this->hasMany(LessonTuitionVideo::class)->latest();
    }
}
