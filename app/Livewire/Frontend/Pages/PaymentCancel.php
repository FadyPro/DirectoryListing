<?php

namespace App\Livewire\Frontend\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend.master')]
class PaymentCancel extends Component
{
    public function render()
    {
        return view('livewire.frontend.pages.payment-cancel');
    }
}
