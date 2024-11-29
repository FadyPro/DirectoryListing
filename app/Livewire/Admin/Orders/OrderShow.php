<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderPlacedNotification;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

#[Layout('layouts.admin.master')]
class OrderShow extends Component
{
    public $order,$model_id,$invoice_id,$payment_method,$payment_status;
    public $transaction_id,$currency_name,$order_status,$id;


    public function mount($id)
    {
        $model = Order::query()->findOrFail($id);
        $this->order = $model;
        $this->id = $model->id;
    }
    #[On('updateOrderStatus')]
    public function render()
    {
        return view('livewire.admin.orders.order-show');
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
    public function updateOrderStatus()
    {
        $model = Order::query()->findOrFail($this->id);
        $model->payment_status = $this->payment_status;
        $model->save();
        $this->dispatch('updateOrderStatus');
        $this->alertSuccess('Order Status Updated Successfully');
//        return redirect()->route('orders.index');
    }
    public function pdfInvoice()
    {
        /** this way to generate pdf with livewire and Mpdf package */
        $order = Order::query()->with(['user','package'])->findOrFail($this->id);
        $html = view('livewire.admin.orders.order-export-pdf', ['order' => $order]);
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->showImageErrors = true;
        $pdf->WriteHTML($html);
        $pdf->SetDisplayMode('fullpage');
        return response()->streamDownload( function () use ($pdf) {
            $pdf->Output('invoice.pdf', Destination::DOWNLOAD);
        }, 'invoice.pdf');
    }
}
