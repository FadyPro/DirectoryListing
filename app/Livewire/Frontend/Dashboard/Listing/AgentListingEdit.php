<?php

namespace App\Livewire\Frontend\Dashboard\Listing;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ListingAmenity;
use App\Models\Location;
use App\Models\Subscription;
use App\Rules\MaxAmenities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.frontend.master')]
class AgentListingEdit extends Component
{
    use WithFileUploads;
    public $saved = false;
    public $user_id,$category_id,$location_id,$package_id,$image,$thumbnail_image,$title,$slug,$description,$phone,$email,$website,$address,
        $facebook_link,$x_link,$linkedin_link,$whatsapp_link,$is_verified,$is_featured,$views,$google_map_embed_code,$file,$show_at_home,
        $expire_date,$seo_title,$seo_description,$status,$is_approved;
    public $amenity = [];
    public $model_id;
    public $listing;

    public function mount($id)
    {
        $model = Listing::query()->findOrFail($id);
        $this->listing = $model;
        $this->model_id = $model->id;
        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->status = $model->status;
        $this->show_at_home = $model->show_at_home;
        $this->category_id = $model->category_id;
        $this->location_id = $model->location_id;
        $this->address = $model->address;
        $this->phone = $model->phone;
        $this->email = $model->email;
        $this->website = $model->website;
        $this->facebook_link = $model->facebook_link;
        $this->x_link = $model->x_link;
        $this->linkedin_link = $model->linkedin_link;
        $this->whatsapp_link = $model->whatsapp_link;
        $this->is_featured = $model->is_featured;
        $this->views = $model->views;
        $this->google_map_embed_code = $model->google_map_embed_code;
        $this->description = $model->description;
        $this->expire_date = $model->expire_date;
        $this->seo_title = $model->seo_title;
        $this->seo_description = $model->seo_description;
        $this->is_approved = $model->is_approved;
        $this->amenity = $model->amenities->pluck('amenity_id')->toArray();
    }
    public function render()
    {
        if(Auth::user()->id !== $this->listing->user_id){
            return abort(403);
        }
        $subscription = Subscription::with('package')->where('user_id', auth()->user()->id)->first();
        if(!$subscription) {
            throw ValidationException::withMessages(['Please Subscribe to a package for create listing']);
        }
        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();
        return view('livewire.frontend.dashboard.listing.agent-listing-edit',compact('categories','locations','amenities','subscription'));
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
            'image' => ['nullable', 'image', 'max:3000'],
            'thumbnail_image' => ['nullable', 'image', 'max:3000'],
            'title' => ['required', 'string', 'max:255', 'unique:listings,title,'.$this->model_id],
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
        ],[
            'title.unique' => 'This title is already exist'
        ]);

        if($this->image){
            @unlink(public_path('uploads/listing/'.$this->listing->image));
            $imageName = uniqid() . '-' . time() . '.' . $this->image->extension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image);
            $image->resize(1920,900)->toJpeg()->save(public_path('\uploads\listing/'.$imageName));
//            $this->avatar->storeAs('uploads/admin_image', $imageName,'public_upload');
        }
        if($this->thumbnail_image){
            @unlink(public_path('uploads/listing/'.$this->listing->thumbnail_image));
            $thumbnailName = uniqid() . '-' . time() . '.' . $this->thumbnail_image->extension();
            $thumbnailManager = new ImageManager(new Driver());
            $thumbnail = $thumbnailManager->read($this->thumbnail_image);
            $thumbnail->resize(600,400)->toJpeg()->save(public_path('\uploads\listing/'.$thumbnailName));
        }
        if($this->file){
            @unlink(public_path('uploads/listing/'.$this->listing->file));
            $fileName = uniqid() . '-' . time() . '.' . $this->file->extension();
            $this->file->storeAs('uploads/listing', $fileName,'public_upload');
        }

        $listing = Listing::findOrFail($this->model_id);
        $listing->user_id = Auth::user()->id;
        $listing->package_id = 0;
        $listing->image = !empty($imageName) ?  $imageName : $listing->image;
        $listing->thumbnail_image = !empty($thumbnailName) ?  $thumbnailName : $listing->thumbnail_image;
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
        $listing->file =  !empty($fileName) ?  $fileName : $listing->file;
        $listing->description = $this->description;
        $listing->google_map_embed_code = $this->google_map_embed_code;
        $listing->seo_title = $this->seo_title;
        $listing->seo_description = $this->seo_description;
        $listing->status = $this->status;
        $listing->is_featured = $this->is_featured;
//        $listing->is_verified = $this->is_verified;
        $listing->expire_date = date('Y-m-d');
        $listing->save();

        ListingAmenity::where('listing_id', $listing->id)->delete();
        foreach($this->amenity as $amenityId) {
            $amenity = new ListingAmenity();
            $amenity->listing_id = $listing->id;
            $amenity->amenity_id = $amenityId;
            $amenity->save();
        }

        $this->alertSuccess('listing Updated Successfully');
        return redirect()->to(route('user.listing.index'));
    }
}
