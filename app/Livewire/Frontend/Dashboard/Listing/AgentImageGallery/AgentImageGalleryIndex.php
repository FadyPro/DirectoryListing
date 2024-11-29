<?php

namespace App\Livewire\Frontend\Dashboard\Listing\AgentImageGallery;

use App\Models\Listing;
use App\Models\ListingImageGallery;
use App\Models\Subscription;
use App\Rules\MaxImages;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.frontend.master')]
class AgentImageGalleryIndex extends Component
{
    use WithFileUploads;

    public $listing_id;
    public $image = [];
    protected $listeners = ['deleteConfirmed'=>'delete'];

    public function mount($id)
    {
        $this->listing_id = $id;
    }

    public function render()
    {
        $listingTitle = Listing::select('title')->where('id', $this->listing_id)->first();
        $images = ListingImageGallery::where('listing_id', $this->listing_id)->get();
        $subscription = Subscription::with('package')->where('user_id', auth()->user()->id)->first();
        return view('livewire.frontend.dashboard.listing.agent-image-gallery.agent-image-gallery-index', compact('listingTitle', 'images', 'subscription'));
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
            'listing_id' => ['required', new MaxImages($this->image)],
            'image.*' => 'required|image|max:2048|mimes:jpeg,jpg,png,gif',
        ], [
            'listing_id.required' => 'jpeg,jpg,png,gif required.',
            'image.*.required' => 'jpeg,jpg,png,gif.',
            'image.*.max' => 'image should be less than420 MB.',
        ]);

        foreach ($this->image as $key => $file)
        {
            $imageName = uniqid() . '-' . time() . '.' .$file->extension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->resize(1920,900)->toJpeg()->save(public_path('\uploads\listing/'.$imageName));
//                $imagesM = uniqid() . '.' . $file->extension();
//                $file->storeAs('uploads/products', $imagesM,'public_upload');
            ListingImageGallery::insert([
                'listing_id' => $this->listing_id,
                'image' => $imageName,
            ]);
        }

        $this->alertSuccess('Images Inserted Successfully');
//        $this->js('window.location.reload()');
    }
    public function destroy($id)
    {
        try {
            $image = ListingImageGallery::findOrFail($id);
            @unlink(public_path('\uploads/listing/'.$image->image));
            $image->delete();
            $this->alertSuccess('Deleted Successfully');
            $this->dispatch('delete-model');
//            $this->js('window.location.reload()');
        }catch(\Exception $e){
            logger($e);
            $this->alertDanger('something went wrong!');
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
