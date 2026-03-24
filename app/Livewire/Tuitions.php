<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Tuition;
class Tuitions extends Component
{
    use WithFileUploads;
    public $tuitions = [];
    public $tuitionModal = false;
    public $selectedTuition;
    public $photoPreview;
    public $photo;
    public $img_path;

    public function mount()
    {
        $this->loadTuitions();
    }

    public function loadTuitions()
    {
        $this->tuitions = Tuition::latest()->limit(20)->get();
    }

    public function addTuition($id = null)
    {
        $this->reset(['photo','photoPreview','img_path','selectedTuition']);

        if ($id) {
            $tuition = Tuition::findOrFail($id);

            $this->selectedTuition = $tuition;
            $this->img_path = $tuition->image;
        }

        $this->tuitionModal = true;
    }

    public function save()
    {
        $this->validate([
            'photo' => $this->selectedTuition ? 'nullable|image|max:2048' : 'required|image|max:2048'
        ]);

        $path = $this->img_path;

        if ($this->photo) {
            $path = $this->photo->store('tuitions', 'public');
        }

        if ($this->selectedTuition) {

            $this->selectedTuition->update([
                'img_path' => $path
            ]);

        } else {

            Tuition::create([
                'img_path' => $path
            ]);

        }

        $this->tuitionModal = false;

        $this->loadTuitions();

        $this->dispatch('swiper-update');
    }
    public function delete($id)
    {
        $tuition = Tuition::findOrFail($id);

        // 파일 삭제 (선택)
        if ($tuition->image && \Storage::disk('public')->exists($tuition->image)) {
            \Storage::disk('public')->delete($tuition->image);
        }

        $tuition->delete();

        $this->loadTuitions();
        $this->dispatch('swiper-update');
    }
    public function render()
    {
        return view('livewire.tuitions');
    }
}
