<?php

namespace App\Livewire\Admin\Hero;

use App\Models\Hero;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin.master')]
class HeroIndex extends Component
{
    use WithFileUploads;
    public $saved = false;
    public $background,$title,$sub_title;
    public $hero;

    public function mount()
    {
        $hero = Hero::first();
        $this->hero = $hero;
        $this->title = $hero->title;
        $this->sub_title = $hero->sub_title;
    }
    public function render()
    {
        $hero = Hero::first();
        return view('livewire.admin.hero.hero-index', compact('hero'));
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
    function save()
    {
        $this->validate([
            'background' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif',
        ]);
        if($this->background){

            @unlink(public_path('uploads/'.$this->hero->background));
            $backgroundName = uniqid() . '-' . time() . '.' . $this->background->extension();
            $backgroundManager = new ImageManager(new Driver());
            $banner = $backgroundManager->read($this->background);
            $banner->resize(1920,900)->toJpeg()->save(public_path('\uploads/'.$backgroundName));
//            $this->avatar->storeAs('uploads/admin_image', $imageName,'public_upload');
        }

            Hero::updateOrCreate(
                ['id' => 1],
                [
                    'background' => !empty($backgroundName) ?  $backgroundName : $this->hero->background,
                    'title' => $this->title,
                    'sub_title' => $this->sub_title
                ]
            );

        $this->saved = true;
        $this->alertSuccess('Profile Successfully Updated');

        return redirect()->back();
    }
}
