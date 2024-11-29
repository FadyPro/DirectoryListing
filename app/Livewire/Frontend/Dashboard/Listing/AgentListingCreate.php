<?php

namespace App\Livewire\Frontend\Dashboard\Listing;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ListingAmenity;
use App\Models\Location;
use App\Models\Subscription;
use App\Rules\MaxAmenities;
use App\Rules\MaxFeatured;
use App\Rules\MaxListings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.frontend.master')]
class AgentListingCreate extends Component
{
    use WithFileUploads;
    public $saved = false;
    public $user_id,$category_id,$location_id,$package_id,$image,$thumbnail_image,$title,$slug,$description,$phone,$email,$website,$address,
        $facebook_link,$x_link,$linkedin_link,$whatsapp_link,$is_verified,$is_featured,$views,$google_map_embed_code,$file,$show_at_home,
        $expire_date,$seo_title,$seo_description,$status,$is_approved;
    public $listing = 0;
    public $amenity = [];

    public function render()
    {
        $subscription = Subscription::with('package')->where('user_id', auth()->user()->id)->first();
        if(!$subscription) {
            throw ValidationException::withMessages(['Please Subscribe to a package for create listing']);
        }
        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();
        return view('livewire.frontend.dashboard.listing.agent-listing-create',compact('categories','locations','amenities','subscription'));
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
            'image' => ['required', 'image', 'max:3000'],
            'thumbnail_image' => ['required', 'image', 'max:3000'],
            'title' => ['required', 'string', 'max:255', 'unique:listings,title'],
            'category_id' => ['required', 'integer'],
            'location_id' => ['required', 'integer'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'website' => ['nullable','url'],
            'facebook_link' => ['nullable','url'],
            'x_link' => ['nullable','url'],
            'linkedin_link' => ['nullable','url'],
            'whatsapp_link' => ['nullable','url'],
            'file' => ['nullable','mimes:png,jpg,csv,pdf', 'max:10000'],
            'amenity.*' => ['nullable', 'integer'],
            'amenity' => [new MaxAmenities()],
            'description' => ['required'],
            'google_map_embed_code' => ['nullable'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'listing'=> ['required',new MaxListings(),new MaxFeatured()],
        ],[
            'title.unique' => 'This title is already exist'
        ]);
        if($this->image){
            $imageName = uniqid() . '-' . time() . '.' . $this->image->extension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image);
            $image->resize(1920,900)->toJpeg()->save(public_path('\uploads\listing/'.$imageName));
//            $this->avatar->storeAs('uploads/admin_image', $imageName,'public_upload');
        }
        if($this->thumbnail_image){
            $thumbnailName = uniqid() . '-' . time() . '.' . $this->thumbnail_image->extension();
            $thumbnailManager = new ImageManager(new Driver());
            $thumbnail = $thumbnailManager->read($this->thumbnail_image);
            $thumbnail->resize(600,400)->toJpeg()->save(public_path('\uploads\listing/'.$thumbnailName));
        }
        if($this->file){
            $fileName = uniqid() . '-' . time() . '.' . $this->file->extension();
            $this->file->storeAs('uploads/listing', $fileName,'public_upload');
        }

        $listing = new Listing();
        $listing->user_id = Auth::user()->id;
        $listing->package_id = 0;
        $listing->image = !empty($imageName) ?  $imageName : 'default.png';
        $listing->thumbnail_image = !empty($thumbnailName) ?  $thumbnailName : 'default.png';
        $listing->title = $this->title;
        $listing->slug = Str::slug($this->title);
        $listing->category_id = $this->category_id;
        $listing->location_id = $this->location_id;
        $listing->address = $this->address;
        $listing->phone = $this->phone;
        $listing->email = $this->email;
        $listing->website = $this->website;
        $listing->facebook_link = $this->facebook_link;
        $listing->x_link = $this->x_link;
        $listing->linkedin_link = $this->linkedin_link;
        $listing->whatsapp_link = $this->whatsapp_link;
        $listing->file =  !empty($fileName) ?  $fileName : 'default.png';;
        $listing->description = $this->description;
        $listing->google_map_embed_code = $this->google_map_embed_code;
        $listing->seo_title = $this->seo_title;
        $listing->seo_description = $this->seo_description;
        $listing->status = $this->status;
        $listing->is_featured = $this->is_featured;
        $listing->is_verified = 0;
        $listing->expire_date = date('Y-m-d');
//        $listing->is_approved = 1;
        $listing->save();

        foreach($this->amenity as $amenityId) {
            $amenity = new ListingAmenity();
            $amenity->listing_id = $listing->id;
            $amenity->amenity_id = $amenityId;
            $amenity->save();
        }

        $this->alertSuccess('listing inserted Successfully');
        return redirect()->to(route('admin.listing.index'));
    }
}
