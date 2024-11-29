<?php

namespace App\Livewire\Admin\Settings\Sections;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class PusherSettings extends Component
{
    public function render()
    {
        return view('livewire.admin.settings.sections.pusher-settings');
    }
}
