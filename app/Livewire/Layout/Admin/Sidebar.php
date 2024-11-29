<?php

namespace App\Livewire\Layout\Admin;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.layout.admin.sidebar');
    }
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
    public function alertSuccess($rel)
    {
        $this->dispatch('alert',
            ['types' => 'success', 'message' => $rel]);
    }

    public function alertDanger($rel)
    {
        $this->dispatch('alert',
            ['types' => 'error', 'message' => $rel]);
    }

    public function ClearAllNotifications()
    {
//        $nottification = OrderPlacedNotification::query()->update(['seen' => 1]);
        $this->alertSuccess('Notification Cleared Successfully');
    }
}
