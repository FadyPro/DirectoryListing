<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Package;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend.master')]
class Packages extends Component
{
    public function render()
    {
        $packages = Package::where('status', 1)->get();
        return view('livewire.frontend.pages.packages', compact('packages'));
    }
}
