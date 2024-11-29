<?php

namespace App\Livewire\Admin\Location;

use App\Models\Location;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class LocationEdit extends Component
{
    public $saved = false;
    public $name,$slug,$show_at_home,$status;
    public $location;
    public $model_id;

    public function mount($id)
    {
        $model = Location::query()->findOrFail($id);
        $this->location = $model;
        $this->model_id = $model->id;
        $this->name = $model->name;
        $this->slug = $model->slug;
        $this->status = $model->status;
        $this->show_at_home = $model->show_at_home;
    }
    public function render()
    {
        return view('livewire.admin.location.location-edit');
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
            'name' => 'required|max:255|unique:locations,name,'.$this->model_id,
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean']
        ],[
            'name.required' => 'Name Required ',
            'status.required' => 'status Required',
            'show_at_home.required' => 'show at home Required',
        ]);

        $this->location->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'show_at_home' => $this->show_at_home,
            'status' => $this->status,
        ]);

        $this->alertSuccess('location Updated Successfully');
        return redirect()->to(route('admin.location.index'));
    }
}
