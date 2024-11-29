<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Package;
use App\Events\CreateOrder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Session;

#[Layout('layouts.frontend.master')]
class Checkout extends Component
{
    public $package;

    public function mount($id)
    {
        $package = Package::findOrFail($id);
        $this->package = $package;
        /** store package id in session */
        Session::put('selected_package_id', $package->id);
        /** if package is free then direct place order */
        if($package->type === 'free' || $package->price == 0) {
            $paymentInfo = [
                'transaction_id' => uniqid(),
                'payment_method' => 'free',
                'paid_amount' => 0,
                'paid_currency' => config('settings.site_default_currency'),
                'payment_status' => 'completed'
            ];

            CreateOrder::dispatch($paymentInfo);
            $this->alertSuccess('package subscribed Successfully');
            return redirect()->route('payment.success');
        }

    }
    public function render()
    {
        return view('livewire.frontend.pages.checkout');
    }
    public function alertSuccess($rel)
    {
        $this->dispatch('alert',
            ['types' => 'success',  'message' => $rel]);
    }
    public function alertDanger($rel)
    {
        $this->dispatch('alert',
            ['types' => 'error',  'message' => $rel]);
    }
}
