<?php

namespace App\Livewire\Lessons;

use Livewire\Component;
use App\Models\Lesson;
use App\Models\LessonVideo;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Videos extends Component
{
    use WithFileUploads;
    public $admin;
    public $video;
    public $lesson;
    public $videoModal;
    public $editingVideo;
    public $editMode = false;
    public function addVideo()
    {
        $this->videoModal = true;
    }
    public function save()
    {
        $this->validate([
            'video' => 'required'
        ]);

        $path = $this->video->storePublicly('specials', 'public');

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
            $this->lesson->lesson_videos()->create([
                'video_path' => $path
            ]);

        }

        $this->reset([
            'videoModal',
            'video',
            'editingVideo',
            'editMode'
        ]);
    }
    public function modifyIdolVideo($id)
    {
        if (!auth()->user()?->admin) {
            abort(403);
        }

        $this->editingVideo = \App\Models\LessonVideo::findOrFail($id);
        $this->editMode = true;
        $this->videoModal = true;
    }
    public function deleteIdolVideo($id)
    {
        if (!auth()->user()?->admin) {
            abort(403);
        }
        $video = \App\Models\LessonVideo::findOrFail($id);

        // delete file from storage
        if ($video->video_path && \Storage::disk('public')->exists($video->video_path)) {
            \Storage::disk('public')->delete($video->video_path);
        }

        // delete database record
        $video->delete();
    }
    
    public function mount(Lesson $lesson)
    {
        if(auth()->user() && auth()->user()->admin)
        {
            $this->admin = true;
        }
        $this->lesson = $lesson;
    }
    public function render()
    {
        return view('livewire.lessons.videos');
    }
}
