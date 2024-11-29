<?php

namespace App\Livewire\Admin\Packages;

use App\Models\Package;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class PackageEdit extends Component
{
    public $saved = false;
    public $type,$name,$price,$number_of_days,$num_of_listing,$num_of_photos,$num_of_video,$num_of_amenities,$num_of_featured_listing,$show_at_home,$status;
    public $package,$model_id;

    public function mount($id)
    {
        $model = Package::query()->findOrFail($id);
        $this->package = $model;
        $this->model_id = $model->id;
        $this->type = $model->type;
        $this->name = $model->name;
        $this->price = $model->price;
        $this->number_of_days = $model->number_of_days;
        $this->num_of_listing = $model->num_of_listing;
        $this->num_of_photos = $model->num_of_photos;
        $this->num_of_video = $model->num_of_video;
        $this->num_of_amenities = $model->num_of_amenities;
        $this->num_of_featured_listing = $model->num_of_featured_listing;
        $this->status = $model->status;
        $this->show_at_home = $model->show_at_home;
    }
    public function render()
    {
        return view('livewire.admin.packages.package-edit');
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
    public function store()
    {
        $this->validate([
            'type' => ['required', 'in:free,paid'],
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric'],
            'number_of_days' => ['required', 'integer'],
            'num_of_listing' => ['required', 'integer'],
            'num_of_photos' => ['required', 'integer'],
            'num_of_video' => ['required', 'integer'],
            'num_of_amenities' => ['required', 'integer'],
            'num_of_featured_listing' => ['required', 'integer'],
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ], [
            'type.required' => 'Type is required',
            'name.required' => 'Name is required',
            'price.required' => 'Price is required',
            'number_of_days.required' => 'Number of days is required',
            'num_of_listing.required' => 'Number of listing is required',
            'num_of_photos.required' => 'Number of photos is required',
            'num_of_video.required' => 'Number of video is required',
            'num_of_amenities.required' => 'Number of amenities is required',
            'num_of_featured_listing.required' => 'Number of featured listing is required',
            'show_at_home.required' => 'Show at home is required',
            'status.required' => 'Status is required',
        ]);

        $this->package->update([
            'type' => $this->type,
            'name' => $this->name,
            'price' => $this->price,
            'number_of_days' => $this->number_of_days,
            'num_of_listing' => $this->num_of_listing,
            'num_of_photos' => $this->num_of_photos,
            'num_of_video' => $this->num_of_video,
            'num_of_amenities' => $this->num_of_amenities,
            'num_of_featured_listing' => $this->num_of_featured_listing,
            'show_at_home' => $this->show_at_home,
            'status' => $this->status,
        ]);

        $this->alertSuccess('Package Updated Successfully');
        return redirect()->to(route('admin.packages.index'));
    }
}
