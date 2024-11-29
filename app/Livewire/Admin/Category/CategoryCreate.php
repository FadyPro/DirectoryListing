<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin.master')]
class CategoryCreate extends Component
{
    use WithFileUploads;
    public $saved = false;
    public $name,$slug,$image_icon,$background_image,$show_at_home,$status;

    public function render()
    {
        return view('livewire.admin.category.category-create');
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
            'name' => 'required|max:255|unique:categories,name',
            'image_icon' => 'required|image|max:3000|mimes:jpeg,jpg,png,gif',
            'background_image' => 'nullable|image|max:3000|mimes:jpeg,jpg,png,gif',
            'status' => 'required|boolean',
            'show_at_home' => 'required|boolean',
        ],[
            'name.required' => 'Name Required ',
            'status.required' => 'status Required',
            'show_at_home.required' => 'show at home Required',
        ]);

        if($this->image_icon){
            $imageName = uniqid() . '-' . time() . '.' . $this->image_icon->extension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image_icon);
            $image->resize(300,300)->toJpeg()->save(public_path('\uploads/'.$imageName));
//            $this->avatar->storeAs('uploads/admin_image', $imageName,'public_upload');
        }
        if($this->background_image){
            $backgroundName = uniqid() . '-' . time() . '.' . $this->background_image->extension();
            $backgroundManager = new ImageManager(new Driver());
            $background = $backgroundManager->read($this->background_image);
            $background->resize(1920,900)->toJpeg()->save(public_path('\uploads/'.$backgroundName));
        }

        $category = new Category();
        $category->image_icon = !empty($imageName) ?  $imageName : 'default.png';
        $category->background_image = !empty($backgroundName) ?  $backgroundName : 'default.png';
        $category->name = $this->name;
        $category->slug = Str::slug($this->name);
        $category->show_at_home = $this->show_at_home;
        $category->status = $this->status;
        $category->save();

        $this->alertSuccess('Categories inserted Successfully');
        return redirect()->to(route('admin.category.index'));
    }


}
