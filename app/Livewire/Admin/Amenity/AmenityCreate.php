<?php

namespace App\Livewire\Admin\Amenity;

use App\Models\Amenity;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin.master')]
class AmenityCreate extends Component
{
    public $saved = false;
    public $name,$slug,$icon,$status;

    public function render()
    {
        return view('livewire.admin.amenity.amenity-create');
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
            'name' => ['required', 'max:255', 'unique:locations,name'],
            'icon' => ['required', 'max:255'],
            'status' => ['required', 'boolean']
        ],[
            'name.required' => 'Name Required ',
            'icon.required' => 'Icon Required',
            'status.required' => 'status Required',
        ]);

        $location = new Amenity();
        $location->name = $this->name;
        $location->icon = $this->icon;
        $location->slug = Str::slug($this->name);
        $location->status = $this->status;
        $location->save();

        $this->alertSuccess('Amenity inserted Successfully');
        return redirect()->to(route('admin.amenity.index'));
    }
}
