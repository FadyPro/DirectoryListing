<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Listing;
use App\Models\ListingSchedule;
use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend.master')]
class ListingView extends Component
{
    public $listing,$openStatus;

    public function mount($slug)
    {
        $listing = Listing::withAvg(['reviews' => function($query){
            $query->where('is_approved', 1);
        }], 'rating')
            ->where(['status' => 1])->where('slug', $slug)->firstOrFail();
        $this->listing = $listing;


    }
    public function render()
    {
        $this->listing->increment('views');
        $openStatus = $this->listingScheduleStatus($this->listing);
        $reviews = Review::with('user')->where(['listing_id' => $this->listing->id, 'is_approved' => 1])->paginate(10);

        $smellerListings = Listing::where('category_id', $this->listing->category_id)
            ->where('id', '!=', $this->listing->id)->orderBy('id', 'DESC')->take(4)->get();

        return view('livewire.frontend.pages.listing-view', compact( 'openStatus', 'reviews', 'smellerListings'));
    }
    function listingScheduleStatus(Listing $listing) : ?string {
        $day = ListingSchedule::where('listing_id', $listing->id)->where('day', \Str::lower(date('l')))->first();
        if($day) {
            $startTime = strtotime($day->start_time);
            $endTime = strtotime($day->end_time);
            if(time() >= $startTime && time() <= $endTime) {
                $this->openStatus = 'open';
            }else {
                $this->openStatus = 'close';
            }
        }
        return $this->openStatus;
    }
}
