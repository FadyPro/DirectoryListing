<?php

namespace App\Livewire\Frontend\Home\Sections;

use App\Models\Package;
use Livewire\Component;

class FeaturedPackageSection extends Component
{
    public function render()
    {
        $packages = Package::where('status', 1)->where('show_at_home', 1)->take(3)->get();
        return view('livewire.frontend.home.sections.featured-package-section', compact('packages'));
    }
}
