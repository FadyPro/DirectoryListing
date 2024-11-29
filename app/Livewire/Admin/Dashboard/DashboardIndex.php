<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class DashboardIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.dashboard-index');
    }
}
