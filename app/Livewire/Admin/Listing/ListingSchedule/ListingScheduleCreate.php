<?php

namespace App\Livewire\Admin\Listing\ListingSchedule;

use App\Models\Listing;
use App\Models\ListingSchedule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class ListingScheduleCreate extends Component
{
    public $listing_id;
    public $day,$start_time,$end_time,$status;

    public function mount($id)
    {
        $this->listing_id = $id;
    }
    public function render()
    {
        $listingTitle = Listing::select('title')->where('id', $this->listing_id)->first();
        return view('livewire.admin.listing.listing-schedule.listing-schedule-create', compact('listingTitle'));
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
    public function deleteConfirmation($id)
    {
        $this->listing_id = $id;
        $this->dispatch('show-delete-confirm');
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

        $schedule = new ListingSchedule();
        $schedule->listing_id = $this->listing_id;
        $schedule->day = $this->day;
        $schedule->start_time = $this->start_time;
        $schedule->end_time = $this->end_time;
        $schedule->status = $this->status;
        $schedule->save();

        $this->alertSuccess('video added Successfully');
        return redirect()->to(route('listing-schedule.index', $this->listing_id));
    }
    public function destroy($id)
    {
        try {
            $model = ListingSchedule::findOrFail($id);
            $model->delete();
            $this->alertSuccess('Deleted Successfully');
            $this->dispatch('delete-model');
        }catch(\Exception $e){
            logger($e);
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
