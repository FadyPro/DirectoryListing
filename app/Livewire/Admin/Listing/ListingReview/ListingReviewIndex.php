<?php

namespace App\Livewire\Admin\Listing\ListingReview;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class ListingReviewIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.listing.listing-review.listing-review-index');
    }
}
