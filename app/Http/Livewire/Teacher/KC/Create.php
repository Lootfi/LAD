<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Course;
use Livewire\Component;

class Create extends Component
{
    public Course $course;
    public $name;
    public $description;

    public function mount()
    {
        $this->course = auth()->user()->teaches;
    }

    public function render()
    {
        return view('livewire.teacher.kc.create');
    }

    public function createKC()
    {
        $this->course->kcs()->create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->resetInput();

        $this->emit('kcCreated');
    }

    public function resetInput()
    {
        $this->name = null;
        $this->description = null;
    }
}
