<?php

namespace App\Livewire\Admin\PaymentSetting\Sections;

use App\Models\PaymentSetting;
use App\Services\PaymentSettingsService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin.master')]
class PaypalSettings extends Component
{
    use WithFileUploads;

    public $saved = false;
    public  $key,$value;
    public $paypal_status,$paypal_country,$paypal_currency,$paypal_currency_rate,$paypal_client_id,$paypal_secret_key,$paypal_app_key,$paypal_image;
    public $paypal;
    public $model_id;

    public function mount()
    {
        $model = PaymentSetting::pluck('value', 'key')->toArray();
        $this->paypal = $model;
        $this->paypal_status = $model['paypal_status'];
        $this->paypal_country = $model['paypal_country'];
        $this->paypal_currency = $model['paypal_currency'];
        $this->paypal_currency_rate = $model['paypal_currency_rate'];
        $this->paypal_client_id = $model['paypal_client_id'];
        $this->paypal_secret_key = $model['paypal_secret_key'];
        $this->paypal_app_key = $model['paypal_app_key'];
    }

    public function render()
    {
        return view('livewire.admin.payment-setting.sections.paypal-settings');
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
            'paypal_status' => ['required', 'boolean'],
            'paypal_country' => ['required'],
            'paypal_currency' => ['required'],
            'paypal_currency_rate' => ['required', 'numeric'],
            'paypal_client_id' => ['required'],
            'paypal_secret_key' => ['required'],
            'paypal_app_key' => ['required'],
        ]);
        if($this->paypal_image){
            $this->validate([
                'paypal_image' => ['nullable', 'image', 'max:3000']
            ]);

            $imagesM = uniqid() . '.' . $this->paypal_image->extension();
            $this->paypal_image->storeAs('uploads', $imagesM,'public_upload');

            PaymentSetting::updateOrCreate(
                ['key' => 'paypal_image'],
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
