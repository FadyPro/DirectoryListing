<?php

namespace App\Livewire\Admin\PaymentSetting\Sections;

use App\Models\PaymentSetting;
use Livewire\Attributes\Layout;
use App\Services\PaymentSettingsService;
use Livewire\Component;
use \Livewire\WithFileUploads;

#[Layout('layouts.admin.master')]
class StripeSettings extends Component
{
    use WithFileUploads;

    public $saved = false;
    public  $key,$value;
    public $stripe_status,$stripe_country,$stripe_currency,$stripe_currency_rate,$stripe_key,$stripe_secret_key,$stripe_image;
    public $stripe;
    public $model_id;

    public function mount()
    {
        $model = PaymentSetting::pluck('value', 'key')->toArray();
        $this->stripe = $model;
        $this->stripe_status = $model['stripe_status'];
        $this->stripe_country = $model['stripe_country'];
        $this->stripe_currency = $model['stripe_currency'];
        $this->stripe_currency_rate = $model['stripe_currency_rate'];
        $this->stripe_key = $model['stripe_key'];
        $this->stripe_secret_key = $model['stripe_secret_key'];
    }
    public function render()
    {
        return view('livewire.admin.payment-setting.sections.stripe-settings');
    }
    public function alertSuccess($rel)
    {
        $this->dispatch('alert',
            ['types' => 'success',  'message' => $rel]);
    }
    public function alertDelete($rel)
    {
        $this->dispatch('alert',
            ['types' => 'error',  'message' => $rel]);
    }
    public function save()
    {
        $validatedData = $this->validate([
            'stripe_status' => ['required', 'boolean'],
            'stripe_country' => ['required'],
            'stripe_currency' => ['required'],
            'stripe_currency_rate' => ['required', 'numeric'],
            'stripe_key' => ['required'],
            'stripe_secret_key' => ['required'],
        ]);
        if($this->stripe_image){
            $this->validate([
                'stripe_image' => ['nullable', 'image', 'max:3000']
            ]);

            $imagesM = uniqid() . '.' . $this->stripe_image->extension();
            $this->stripe_image->storeAs('uploads', $imagesM,'public_upload');

            PaymentSetting::updateOrCreate(
                ['key' => 'stripe_image'],
                ['value' => $imagesM]
            );
        }
        foreach($validatedData as $key => $value){
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(PaymentSettingsService::class);
        $settingsService->clearCachedSettings();

        $this->saved = true;
        $this->alertSuccess('General Settings Successfully Updated');
    }
}
