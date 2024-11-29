<div>
    <section id="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <livewire:frontend.dashboard.user-dashboard-sidebar />
                </div>
                <div class="col-lg-9">
                    <div class="dashboard_content">
                        <div class="my_listing">
                            <h4>basic information</h4>
                            <form wire:submit="save">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-8 col-md-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input wire:model="name" type="text" placeholder="Name" name="name" required>
                                                        @error('name') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label>phone <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input wire:model="phone" type="text" placeholder="1234" name="phone"  required>
                                                        @error('phone') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>email <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input wire:model="email" type="Email" placeholder="Email" name="email"  required>
                                                        @error('email') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>Address <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input wire:model="address" type="text" placeholder="Address" name="address" required>
                                                        @error('address') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>About Me <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <textarea wire:model="about" cols="3" rows="3" placeholder="Your Text" name="about" required>{!! $user->about !!}</textarea>
                                                        @error('about') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Website</label>
                                                    <div class="input_area">
                                                        <input wire:model="website" type="text" placeholder="Website" name="website" >
                                                        @error('website') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Facebook</label>
                                                    <div class="input_area">
                                                        <input wire:model="fb_link" type="text" placeholder="Facebook" name="fb_link" >
                                                        @error('fb_link') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>X</label>
                                                    <div class="input_area">
                                                        <input wire:model="x_link" type="text" placeholder="X" name="x_link" >
                                                        @error('x_link') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Linkedin</label>
                                                    <div class="input_area">
                                                        <input wire:model="in_link" type="text" placeholder="Linkedin" name="in_link" >
                                                        @error('in_link') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Whatsapp</label>
                                                    <div class="input_area">
                                                        <input wire:model="wa_link" type="text" placeholder="Whatsapp" name="wa_link" >
                                                        @error('wa_link') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Instragram</label>
                                                    <div class="input_area">
                                                        <input wire:model="instra_link" type="text" placeholder="Instragram" name="instra_link">
                                                        @error('instra_link') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-5">
                                        <div class="my_listing_single">
                                            <div>
                                                <label for="avatar" id="image-label">Avatar</label>
                                                <div wire:loading wire:target="avatar">Uploading...</div>
                                                <input wire:model="avatar" name="avatar" type="file" class="form-control" />
                                                @error('avatar') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                            @if ($avatar)
                                                <img src="{{ $avatar->temporaryUrl() }}" class="p-1 bg-primary" width="100" height="100">
                                            @else
                                                <img src="{{(!empty(auth()->user()->avatar))? url('/uploads/profile/'.auth()->user()->avatar) : url('/uploads/avatar.png')}}" style="width: 100px; height: 100px">
                                            @endif
                                        </div>
                                        <div class="my_listing_single">
                                            <div>
                                                <label for="banner" id="image-label">Banner</label>
                                                <div wire:loading wire:target="banner">Uploading...</div>
                                                <input wire:model="banner" name="banner" type="file" class="form-control" />
                                                @error('banner') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                            @if ($banner)
                                                <img src="{{ $banner->temporaryUrl() }}" class="p-1 bg-primary" width="100" height="100">
                                            @else
                                                <img src="{{(!empty(auth()->user()->banner))? url('/uploads/profile/'.auth()->user()->banner) : url('/uploads/banner.png')}}" style="width: 100px; height: 100px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="read_btn">Update</button>
                                </div>

                            </form>
                        </div>
                        <div class="my_listing list_mar">
                            <h4>change password</h4>
                            <form wire:submit="updatePassword">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>current password</label>
                                            <div class="input_area">
                                                <input wire:model="current_password" type="password" placeholder="Current Password" name="current_password">
                                                @error('current_password') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>new password</label>
                                            <div class="input_area">
                                                <input wire:model="password" type="password" placeholder="New Password" name="password">
                                                @error('password') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="my_listing_single">
                                            <label>confirm password</label>
                                            <div class="input_area">
                                                <input wire:model="password_confirmation" type="password" placeholder="Confirm Password" name="password_confirmation">
                                                @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="read_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        span{
            color: red;
        }
    </style>
</div>
