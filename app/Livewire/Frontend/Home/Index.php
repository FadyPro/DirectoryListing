<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend.master')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.index');
    }
}
