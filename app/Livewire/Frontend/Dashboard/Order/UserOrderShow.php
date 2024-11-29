<?php

namespace App\Livewire\Frontend\Dashboard\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

#[Layout('layouts.frontend.master')]
class UserOrderShow extends Component
{
    public $order;

    public function mount($id)
    {
        $order = Order::findOrFail($id);
        $this->order = $order;
    }
    public function render()
    {
        return view('livewire.frontend.dashboard.order.user-order-show');
    }
    public function pdfInvoice()
    {
        /** this way to generate pdf with livewire and Mpdf package */
        $order = Order::query()->with(['user','package'])->findOrFail($this->order->id);
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
