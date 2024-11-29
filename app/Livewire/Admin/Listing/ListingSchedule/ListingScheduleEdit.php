<?php

namespace App\Livewire\Admin\Listing\ListingSchedule;

use App\Models\ListingSchedule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class ListingScheduleEdit extends Component
{
    public $day,$start_time,$end_time,$status;
    public $model_id;
    public $ListingSchedule;

    public function mount($id)
    {
        $model = ListingSchedule::query()->findOrFail($id);
        $this->ListingSchedule = $model;
        $this->model_id = $model->id;
        $this->day = $model->day;
        $this->start_time = $model->start_time;
        $this->end_time = $model->end_time;
        $this->status = $model->status;
    }
    public function render()
    {
        return view('livewire.admin.listing.listing-schedule.listing-schedule-edit');
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
    public function save()
    {
        $this->validate([
            'day' => ['required', 'string'],
            'start_time' => ['required', 'string'],
            'end_time' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ], [
            'day.required' => 'Day is required',
            'start_time.required' => 'Start time is required',
            'end_time.required' => 'End time is required',
            'status.required' => 'Status is required',
        ]);

        $this->ListingSchedule->update([
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
        ]);

        $this->alertSuccess('Listing Schedule Updated Successfully');
        return redirect()->to(route('listing-schedule.index', $this->ListingSchedule->listing_id));
    }
}
