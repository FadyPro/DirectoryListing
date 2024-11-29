<?php

namespace App\Livewire\Admin\Settings\Sections;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class AppearanceSettings extends Component
{
    public function render()
    {
        return view('livewire.admin.settings.sections.appearance-settings');
    }
}
