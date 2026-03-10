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
    public $editingVideo;
    public $editMode = false;
    public function addVideo($id)
    {
        $this->selected_lesson = Lesson::find($id);
        $this->videoModal = true;
    }
    public function save()
    {
        $this->validate([
            'video' => 'required'
        ]);

        $path = $this->video->storePublicly('tuitions', 'public');

        if ($this->editMode && $this->editingVideo) {

            // delete old file
            if ($this->editingVideo->video_path &&
                Storage::disk('public')->exists($this->editingVideo->video_path)) {

                Storage::disk('public')->delete($this->editingVideo->video_path);
            }

            // update record
            $this->editingVideo->update([
                'video_path' => $path
            ]);

        } else {

            // create new
            $this->selected_lesson->lesson_tuition_videos()->create([
                'video_path' => $path
            ]);

        }

        $this->reset([
            'videoModal',
            'video',
            'selected_lesson',
            'editingVideo',
            'editMode'
        ]);
    }
    public function modifyIdolVideo($id)
    {
        if (!auth()->user()?->admin) {
            abort(403);
        }

        $this->editingVideo = \App\Models\LessonTuitionVideo::findOrFail($id);
        $this->editMode = true;
        $this->videoModal = true;
    }
    public function deleteIdolVideo($id)
    {
        if (!auth()->user()?->admin) {
            abort(403);
        }
        $video = \App\Models\LessonTuitionVideo::findOrFail($id);

        // delete file from storage
        if ($video->video_path && \Storage::disk('public')->exists($video->video_path)) {
            \Storage::disk('public')->delete($video->video_path);
        }

        // delete database record
        $video->delete();
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
        $lessons = Lesson::with([
            'mainpage_lesson_photos',
            'lesson_tuition_videos'
        ])->get();
        return view('livewire.courses', ['lessons' => $lessons]);
    }
}
