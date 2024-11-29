<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Listing;
use Livewire\Component;

class ListingModal extends Component
{
    public $model_id, $selectId;
    public $listing;
    public $isOpen = 0;

    public function mount($selectId)
    {
        $model = Listing::findOrFail($selectId);
        $this->listing = $model;
        $this->model_id = $model->id;

    }
    public function render()
    {
        return view('livewire.frontend.pages.listing-modal');
    }
    public function closeModal()
    {
        $this->selectId = null;
        $this->dispatch('hideModal', false);
        $this->isOpen = false;
//        $this->js('window.location.reload()');
    }
}
