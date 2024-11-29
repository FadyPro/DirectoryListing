<?php

namespace App\Livewire\Frontend\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend.master')]
class PaymentSuccess extends Component
{
    public function render()
    {
        return view('livewire.frontend.pages.payment-success');
    }
}
