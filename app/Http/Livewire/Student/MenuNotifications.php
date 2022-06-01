<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class MenuNotifications extends Component
{

    public function getListeners()
    {
        $authId = auth()->id();
        return [
            "echo-private:users.{$authId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'notified',
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
        $this->notifications = auth()->user()->unreadNotifications;
    }
}
