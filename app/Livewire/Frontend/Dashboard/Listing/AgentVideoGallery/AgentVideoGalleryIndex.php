<?php

namespace App\Livewire\Frontend\Dashboard\Listing\AgentVideoGallery;

use App\Models\Listing;
use App\Models\ListingVideoGallery;
use App\Models\Subscription;
use App\Rules\MaxVideos;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend.master')]
class AgentVideoGalleryIndex extends Component
{
    public $listing_id,$video_url;
    protected $listeners = ['deleteConfirmed'=>'delete'];

    public function mount($id)
    {
        $this->listing_id = $id;
    }
    public function render()
    {
        $listing = Listing::select('title','id','user_id')->where('id', $this->listing_id)->first();
//        if(Auth::user()->id !== $listing->user_id){
//            return abort(403);
//        }
        $videos = ListingVideoGallery::where('listing_id', $this->listing_id)->get();
        $listingTitle = $listing;
        $subscription = Subscription::with('package')->where('user_id', auth()->user()->id)->first();

        return view('livewire.frontend.dashboard.listing.agent-video-gallery.agent-video-gallery-index', compact('listingTitle', 'videos', 'subscription'));
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
            'listing_id' => ['required', new MaxVideos()],
            'video_url' => ['required', 'url'],
        ], [
            'listing_id.required' => 'Please Select Listing',
            'video_url.required' => 'Please Enter Video Url',
            'video_url.url' => 'Please Enter Valid Video Url',
        ]);

        $video = new ListingVideoGallery();
        $video->listing_id = $this->listing_id;
        $video->video_url = $this->video_url;
        $video->save();

        $this->alertSuccess('video added Successfully');

    }
    public function destroy($id)
    {
        try {
            $model = ListingVideoGallery::findOrFail($id);
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
