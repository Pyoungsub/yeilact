<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\MainVideo as Main;
use Illuminate\Support\Facades\Storage;

class MainVideo extends Component
{
    use WithFileUploads;

    public $video;
    public $videoModal = false;

    public $mainVideo;
    public $currentVideo;

    public function mount()
    {
        $this->mainVideo = Main::first();

        if ($this->mainVideo) {
            $this->currentVideo = $this->mainVideo->video_path;
        }
    }

    public function openModal()
    {
        $this->reset('video');
        if ($this->mainVideo) {
            $this->currentVideo = $this->mainVideo->video_path;
        }
        $this->videoModal = true;
    }

    public function save()
    {
        $this->validate([
            'video' => 'required|mimes:mp4,webm|max:102400'
        ]);

        $path = $this->video->store('videos', 'public');

        $video = Main::updateOrCreate(
            ['id' => 1],
            ['video_path' => $path]
        );

        $this->mainVideo = $video;
        $this->currentVideo = $video->video_path;
        $this->reset('video');
        $this->videoModal = false;
    }

    public function delete()
    {
        if (!$this->mainVideo) {
            return;
        }

        if (Storage::disk('public')->exists($this->mainVideo->video_path)) {
            Storage::disk('public')->delete($this->mainVideo->video_path);
        }

        $this->mainVideo->delete();

        $this->mainVideo = null;
        $this->currentVideo = null;
    }

    public function render()
    {
        return view('livewire.main-video');
    }
}