<?php

namespace App\Livewire\Lessons;

use Livewire\Component;
use App\Models\Lesson;
use App\Models\LessonSpecial;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Specials extends Component
{
    use WithFileUploads;
    public $lesson;
    public $specials = [];
    public $specialModal = false;
    public $selectedspecial;
    public $photoPreview;
    public $photo;
    public $img_path;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->loadspecials();
    }

    public function loadspecials()
    {
        $this->specials = $this->lesson->lesson_specials()->get();
    }

    public function addspecial($id = null)
    {
        $this->reset(['photo','photoPreview','img_path','selectedspecial']);

        if ($id) {
            $special = LessonSpecial::findOrFail($id);

            $this->selectedspecial = $special;
            $this->img_path = $special->image;
        }

        $this->specialModal = true;
    }

    public function save()
    {
        $this->validate([
            'photo' => $this->selectedspecial ? 'nullable|image|max:2048' : 'required|image|max:2048'
        ]);

        $path = $this->img_path;

        if ($this->photo) {
            $path = $this->photo->store('specials', 'public');
        }

        if ($this->selectedspecial) {

            $this->selectedspecial->update([
                'img_path' => $path
            ]);

        } else {
            LessonSpecial::create([
                'lesson_id' => $this->lesson->id,
                'img_path' => $path
            ]);

        }

        $this->specialModal = false;

        $this->loadspecials();

        $this->dispatch('swiper-update');
    }
    public function delete($id)
    {
        $special = LessonSpecial::findOrFail($id);

        // 파일 삭제 (선택)
        if ($special->image && \Storage::disk('public')->exists($special->image)) {
            \Storage::disk('public')->delete($special->image);
        }

        $special->delete();

        $this->loadspecials();
        $this->dispatch('swiper-update');
    }
    public function render()
    {
        return view('livewire.lessons.specials');
    }
}
