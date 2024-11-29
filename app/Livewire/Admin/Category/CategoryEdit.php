<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin.master')]
class CategoryEdit extends Component
{
    use WithFileUploads;
    public $saved = false;
    public $name,$slug,$image_icon,$background_image,$show_at_home,$status;
    public $category;
    public $model_id;

    public function mount($id)
    {
        $model = Category::query()->findOrFail($id);
        $this->category = $model;
        $this->model_id = $model->id;
        $this->name = $model->name;
        $this->slug = $model->slug;
        $this->status = $model->status;
        $this->show_at_home = $model->show_at_home;
    }
    public function render()
    {
        return view('livewire.admin.category.category-edit');
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
            'image_icon' => 'required|image|max:3000|mimes:jpeg,jpg,png,gif',
            'background_image' => 'nullable|image|max:3000|mimes:jpeg,jpg,png,gif',
            'name' => 'required|max:255|unique:categories,name,'.$this->model_id,
            'status' => 'required|boolean',
            'show_at_home' => 'required|boolean',
        ],[
            'name.required' => 'Name Required ',
            'slug.required' => 'slug Required',
            'status.required' => 'status Required',
            'show_at_home.required' => 'show at home Required',
        ]);

        if($this->image_icon){
            @unlink(public_path('uploads/'.$this->category->image_icon));
            $imageName = uniqid() . '-' . time() . '.' . $this->image_icon->extension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->image_icon);
            $image->resize(300,300)->toJpeg()->save(public_path('\uploads/'.$imageName));
//            $this->avatar->storeAs('uploads/admin_image', $imageName,'public_upload');
        }
        if($this->background_image){
            @unlink(public_path('uploads/'.$this->category->background_image));
            $backgroundName = uniqid() . '-' . time() . '.' . $this->background_image->extension();
            $backgroundManager = new ImageManager(new Driver());
            $background = $backgroundManager->read($this->background_image);
            $background->resize(1920,900)->toJpeg()->save(public_path('\uploads/'.$backgroundName));
        }

        $this->category->update([
            'image_icon' => !empty($imageName) ?  $imageName : $this->category->image_icon,
            'background_image' => !empty($backgroundName) ?  $backgroundName : $this->category->background_image,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'show_at_home' => $this->show_at_home,
            'status' => $this->status,
        ]);

        $this->alertSuccess('Categories Updated Successfully');
        return redirect()->to(route('admin.category.index'));
    }
}
