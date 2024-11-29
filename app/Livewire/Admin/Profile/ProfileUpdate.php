<?php

namespace App\Livewire\Admin\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\WithFileUploads;

#[Layout('layouts.admin.master')]
class ProfileUpdate extends Component
{
    use WithFileUploads;
    public $saved = false;
    public $name,$email,$phone,$address,$user_id,$about,$website,$fb_link,$x_link,$in_link,$wa_link,$instra_link;
    public $current_password,$password,$password_confirmation;
    public $avatar,$banner;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->phone;
        $this->address = Auth::user()->address;
        $this->about = Auth::user()->about;
        $this->website = Auth::user()->website;
        $this->fb_link = Auth::user()->fb_link;
        $this->x_link = Auth::user()->x_link;
        $this->in_link = Auth::user()->in_link;
        $this->wa_link = Auth::user()->wa_link;
        $this->instra_link = Auth::user()->instra_link;
    }
    public function render()
    {
        return view('livewire.admin.profile.profile-update');
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
    public function updatedPhoto()
    {
        $this->validate([
            'avatar' => 'image|max:10',
            'banner' => 'image|max:10'
        ]);
    }
    public function save()
    {
        $this->validate([
            'name' => 'max:255',
            'email' => ['max:255','email',"unique:users,email,{$this->user_id},id"],
            'phone' => 'max:255',
            'address' => 'max:255',
            'avatar' => 'nullable|image|max:100|mimes:jpeg,jpg,png,gif',
            'banner' => 'nullable|image|max:200|mimes:jpeg,jpg,png,gif',
        ]);

        if($this->avatar){
            @unlink(public_path('uploads/profile/'.Auth::user()->avatar));
            $imageName = uniqid() . '-' . time() . '.' . $this->avatar->extension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->avatar);
            $image->resize(300,300)->toJpeg()->save(public_path('\uploads\profile/'.$imageName));
//            $this->avatar->storeAs('uploads/admin_image', $imageName,'public_upload');
        }
        if($this->banner){
            @unlink(public_path('uploads/profile/'.Auth::user()->banner));
            $bannerName = uniqid() . '-' . time() . '.' . $this->banner->extension();
            $bannerManager = new ImageManager(new Driver());
            $banner = $bannerManager->read($this->banner);
            $banner->resize(1200,750)->toJpeg()->save(public_path('\uploads\profile/'.$bannerName));
//            $this->avatar->storeAs('uploads/admin_image', $imageName,'public_upload');
        }
        if ($this->avatar || $this->banner)
        {
            Auth::user()->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'avatar' => ($this->avatar ? $imageName: Auth::user()->avatar),
                'banner' => ($this->banner ? $bannerName: Auth::user()->banner),
                'about' => $this->about,
                'website' => $this->website,
                'fb_link' => $this->fb_link,
                'x_link' => $this->x_link,
                'in_link' => $this->in_link,
                'wa_link' => $this->wa_link,
                'instra_link' => $this->instra_link,
            ]);
        }else{
            Auth::user()->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'about' => $this->about,
                'website' => $this->website,
                'fb_link' => $this->fb_link,
                'x_link' => $this->x_link,
                'in_link' => $this->in_link,
                'wa_link' => $this->wa_link,
                'instra_link' => $this->instra_link,
            ]);
        }

        $this->saved = true;
        $this->alertSuccess('Profile Successfully Updated');
    }
    public function updatePassword()
    {
        $this->validate([
//            'current_password' => [
//                'required', function ($attribute, $value, $fail) {
//                    if (!Hash::check($value, Auth::user()->password)) {
//                        $fail('Current Password Not Correct');
//                        $this->alertDanger('Current Password Not Correct');
//                    }
//                },
//            ],
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password'
        ],[
//            'current_password.required' => 'Current Password required.',
//            'password.required' => 'password required.',
//            'password_confirmation.required' => 'password confirmation required.',
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);
        $this->saved = true;
        $this->alertSuccess('Password successfully updated');
    }
}
