<?php

namespace App\Livewire\Frontend\Dashboard\Listing\AgentSchedule;

use App\Models\Listing;
use App\Models\ListingSchedule;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.frontend.master')]
class AgentScheduleIndex extends Component
{
    use WithPagination;

    public $model_id,$listing_id;
    public $paginate = 10;
    public $search = "";
    public $sections = null;
    public $selectedSection = null;
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;
    protected $listeners = ['deleteConfirmed'=>'delete'];

    protected $paginationTheme = 'bootstrap';

    public function mount($id)
    {
        $this->listing_id = $id;
    }
    public function render()
    {
        $listing = Listing::select('title','id','user_id')->where('id', $this->listing_id)->first();
        if(Auth::user()->id !== $listing->user_id){
            return abort(403);
        }
        $listingTitle = $listing;
        $model = ListingSchedule::query()->where('listing_id', $this->listing_id)->paginate($this->paginate);
        return view('livewire.frontend.dashboard.listing.agent-schedule.agent-schedule-index', compact('listingTitle','model'));
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
        $this->model_id = $id;
        $this->dispatch('show-delete-confirm');
    }

    public function deleteOne($id)
    {
        try{
            $item =  ListingSchedule::findOrFail($id);

            $listing = Listing::select('title','id','user_id')->where('id', $item->listing_id)->first();
            if(Auth::user()->id !== $listing->user_id){
                return abort(403);
            }

            $item->delete();
            $this->alertSuccess('Deleted Successfully');
            $this->dispatch('delete-model');
            return redirect()->to(route('admin.category.index'));
        }catch(\Exception $e){
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }

    }


}
