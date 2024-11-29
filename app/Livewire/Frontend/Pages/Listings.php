<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Location;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Layout('layouts.frontend.master')]
class Listings extends Component
{
    use WithPagination;

    #[Url]
    public $category = null,$location = null, $search = null, $amenity = [];
    public $selectId;
    public $isOpen = 0;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $listings = Listing::withAvg(['reviews' => function($query) {
            $query->where('is_approved', 1);
        }], 'rating')
            ->withCount(['reviews' => function($query) {
                $query->where('is_approved', 1);
            }])->with(['category', 'location'])->where(['status' => 1, 'is_approved' => 1]);

        $listings->when($this->category , function($query) {
            $query->whereHas('category', function($query) {
                $query->where('slug', $this->category);
            });
        });

        $listings->when($this->search, function($query) {
            $query->where(function($subQuery) {
                $subQuery->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        });

        $listings->when($this->location, function($query) {
            $query->whereHas('location', function($subQuery) {
                $subQuery->where('slug', $this->location);
            });
        });

        $listings->when($this->amenity, function($query) {

            $amenityIds = Amenity::whereIn('slug', $this->amenity)->pluck('id');

            $query->whereHas('amenities', function($subQuery) use ($amenityIds) {
                $subQuery->whereIn('amenity_id', $amenityIds);
            });
        });

        $listings = $listings->paginate(12);

        $categories = Category::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        $amenities = Amenity::where('status', 1)->get();

        return view('livewire.frontend.pages.listings', compact('listings', 'categories', 'locations', 'amenities'));
    }
    public function openModal($id)
    {
        $this->selectId = $id;
        $this->isOpen = true;
        $this->dispatch('showModal');
//        $this->dispatch('openModal', ['selectId' => $this->selectId]);
    }
    #[On('hideModal')]
    public function updatedIsOpen()
    {
        $this->isOpen = 0;
    }
}
