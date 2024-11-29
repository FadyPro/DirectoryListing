<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Profile</h1>
{{--            <div class="section-header-breadcrumb">--}}
{{--                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>--}}
{{--                <div class="breadcrumb-item"><a href="#">Posts</a></div>--}}
{{--                <div class="breadcrumb-item">Create New Post</div>--}}
{{--            </div>--}}
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Profile</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit="save">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="avatar" id="image-label">Choose File</label>
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="banner" id="image-label">Choose File</label>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name <span class="text-danger">*</span></label>
                                            <input wire:model="name" type="text" class="form-control" required >
                                            @error('name') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email <span class="text-danger">*</span></label>
                                            <input wire:model="email" type="text" class="form-control" name="email" required>
                                            @error('email') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone <span class="text-danger">*</span></label>
                                            <input wire:model="phone" type="text" class="form-control" name="phone" required>
                                            @error('phone') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Address <span class="text-danger">*</span></label>
                                            <input wire:model="address" type="text" class="form-control" name="address" required>
                                            @error('address') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">About <span class="text-danger">*</span></label>
                                            <textarea wire:model="about" name="about" class="form-control" required></textarea>
                                            @error('about') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Website</label>
                                            <input wire:model="website" type="text" class="form-control" name="website">
                                            @error('website') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input wire:model="fb_link" type="text" class="form-control" name="fb_link">
                                            @error('fb_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">X</label>
                                            <input wire:model="x_link" type="text" class="form-control" name="x_link">
                                            @error('x_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Linkedin</label>
                                            <input wire:model="in_link" type="text" class="form-control" name="in_link">
                                            @error('in_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Whatsapp</label>
                                            <input wire:model="wa_link" type="text" class="form-control" name="wa_link">
                                            @error('wa_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Instragram</label>
                                            <input wire:model="instra_link" type="text" class="form-control" name="instra_link">
                                            @error('instra_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Password</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit="updatePassword">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password <span class="text-danger">*</span></label>
                                        <input wire:model="password" type="password" class="form-control" name="password" required>
                                        @error('password') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input wire:model="password_confirmation" type="password" class="form-control" name="password_confirmation"
                                               required>
                                        @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
