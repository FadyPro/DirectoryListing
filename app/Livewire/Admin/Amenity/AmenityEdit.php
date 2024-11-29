<?php

namespace App\Livewire\Admin\Amenity;

use App\Models\Amenity;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class AmenityEdit extends Component
{
    public $saved = false;
    public $name,$slug,$icon,$status;
    public $amenity;
    public $model_id;

    public function mount($id)
    {
        $model = Amenity::query()->findOrFail($id);
        $this->amenity = $model;
        $this->model_id = $model->id;
        $this->name = $model->name;
        $this->icon = $model->icon;
        $this->slug = $model->slug;
        $this->status = $model->status;
    }
    public function render()
    {
        return view('livewire.admin.amenity.amenity-edit');
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
    #[On('setIcon')]
    public function icon($title = null)
    {
        $this->icon = $title;
    }
    public function save()
    {
        $this->validate([
            'name' => 'required|max:255|unique:amenities,name,'.$this->model_id,
            'icon' => 'required|max:255',
            'status' => ['required', 'boolean']
        ],[
            'name.required' => 'Name Required ',
            'status.required' => 'status Required',
        ]);

        $this->amenity->update([
            'icon' => $this->icon,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'show_at_home' => $this->show_at_home,
            'status' => $this->status,
        ]);

        $this->alertSuccess('Amenity Updated Successfully');
        return redirect()->to(route('admin.amenity.index'));
    }
}
