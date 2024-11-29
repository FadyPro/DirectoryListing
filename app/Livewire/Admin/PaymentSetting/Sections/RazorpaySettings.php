<?php

namespace App\Livewire\Admin\PaymentSetting\Sections;

use App\Models\PaymentSetting;
use Livewire\Attributes\Layout;
use App\Services\PaymentSettingsService;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin.master')]
class RazorpaySettings extends Component
{
    use WithFileUploads;

    public $saved = false;
    public  $key,$value;
    public $razorpay_status,$razorpay_country,$razorpay_currency,$razorpay_currency_rate,$razorpay_key,$razorpay_secret_key,$razorpay_image;
    public $razorpay;
    public $model_id;

    public function mount()
    {
        $model = PaymentSetting::pluck('value', 'key')->toArray();
        $this->razorpay = $model;
        $this->razorpay_status = $model['razorpay_status'];
        $this->razorpay_country = $model['razorpay_country'];
        $this->razorpay_currency = $model['razorpay_currency'];
        $this->razorpay_currency_rate = $model['razorpay_currency_rate'];
        $this->razorpay_key = $model['razorpay_key'];
        $this->razorpay_secret_key = $model['razorpay_secret_key'];
    }
    public function render()
    {
        return view('livewire.admin.payment-setting.sections.razorpay-settings');
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
            'razorpay_status' => ['required', 'boolean'],
            'razorpay_country' => ['required'],
            'razorpay_currency' => ['required'],
            'razorpay_currency_rate' => ['required', 'numeric'],
            'razorpay_key' => ['required'],
            'razorpay_secret_key' => ['required'],
        ]);
        if($this->razorpay_image){
            $this->validate([
                'razorpay_image' => ['nullable', 'image', 'max:3000']
            ]);

            $imagesM = uniqid() . '.' . $this->razorpay_image->extension();
            $this->razorpay_image->storeAs('uploads', $imagesM,'public_upload');

            PaymentSetting::updateOrCreate(
                ['key' => 'razorpay_image'],
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
