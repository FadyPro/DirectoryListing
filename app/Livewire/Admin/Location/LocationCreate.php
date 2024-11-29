<?php

namespace App\Livewire\Admin\Location;

use App\Models\location;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.master')]
class LocationCreate extends Component
{
    public $saved = false;
    public $name,$slug,$show_at_home,$status;

    public function render()
    {
        return view('livewire.admin.location.location-create');
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
            'name' => ['required', 'max:255', 'unique:locations,name'],
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean']
        ],[
            'name.required' => 'Name Required ',
            'status.required' => 'status Required',
            'show_at_home.required' => 'show at home Required',
        ]);

        $location = new Location();
        $location->name = $this->name;
        $location->slug = Str::slug($this->name);
        $location->show_at_home = $this->show_at_home;
        $location->status = $this->status;
        $location->save();

        $this->alertSuccess('location inserted Successfully');
        return redirect()->to(route('admin.location.index'));
    }
}
