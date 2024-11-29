<?php

namespace App\Livewire\Frontend\Home\Sections;

use App\Models\Category;
use App\Models\Hero;
use App\Models\Location;
use Livewire\Component;

class BannerSection extends Component
{
    public function render()
    {
        $hero = Hero::first();
        $categories = Category::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        return view('livewire.frontend.home.sections.banner-section', compact('hero', 'categories', 'locations'));
    }
}
