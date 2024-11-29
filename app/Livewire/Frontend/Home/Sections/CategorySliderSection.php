<?php

namespace App\Livewire\Frontend\Home\Sections;

use App\Models\Category;
use Livewire\Component;

class CategorySliderSection extends Component
{
    public function render()
    {
        $categories = Category::where('status', 1)->get();
        return view('livewire.frontend.home.sections.category-slider-section', compact('categories'));
    }
}
