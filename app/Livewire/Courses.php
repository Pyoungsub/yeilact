<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lesson;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class Courses extends Component
{
    use WithFileUploads;

    public $admin;
    public $video;
    public $selected_lesson;
    public $videoModal;
    public function addVideo($id)
    {
        $this->selected_lesson = Lesson::find($id);
        $this->videoModal = true;
    }
    public function save()
    {
        $validated = $this->validate([ 
            'video' => 'required',
        ]);
        $path = $this->video->storePublicly('tuitions', 'public');
        $this->selected_lesson->lesson_tuition_videos()->create(['video_path' => $path]);
        $this->reset(['videoModal', 'video', 'selected_lesson']);
    }
    public function mount()
    {
        if(auth()->user() && auth()->user()->admin)
        {
            $this->admin = true;
        }
    }
    public function render()
    {
        $lessons = Lesson::with('mainpage_lesson_photos')->get();
        return view('livewire.courses', ['lessons' => $lessons]);
    }
}
