<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Lesson::insert([
            ['lesson' => 'high-school-entrance', 'lesson_ko' => '예고 입시반', 'created_at' => now(), 'updated_at' => now()],
            ['lesson' => 'college-entrance', 'lesson_ko' => '대학입시반', 'created_at' => now(), 'updated_at' => now()],
            ['lesson' => 'basic', 'lesson_ko' => '연기기초*오디션반(중등/고등)', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
