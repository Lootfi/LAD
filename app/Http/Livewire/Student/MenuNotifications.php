<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class MenuNotifications extends Component
{

    protected function getListeners()
    {
        return [
            "echo:App.Models.User.{auth()->id()}," => 'notified',
        ];
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->notifications = auth()->user()->unreadNotifications;
    }
    public function render()
    {
        return view('livewire.student.menu-notifications');
    }

    public function notified()
    {
        dd('help');
    }
}
