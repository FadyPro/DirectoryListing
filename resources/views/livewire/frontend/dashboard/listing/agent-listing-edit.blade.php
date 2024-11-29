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
                            <h4>Create Listing</h4>
                            <form wire:submit.prevent="save">
                                @csrf
                                <input wire:model="listing" type="hidden" name="listing" value="0">
                                @foreach ($errors->all() as $message)
                                    <div class="alert alert-danger alert-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Image <span class="text-danger">*</span></label>
                                            <div>
                                                <div wire:loading wire:target="image">Uploading...</div>
                                                <input wire:model="image" name="image" type="file" class="form-control" />
                                                @error('image') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                            @if ($image)
                                                <img src="{{ $image->temporaryUrl() }}" class="p-1 bg-primary" width="100" height="100">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Thumbnail Image <span class="text-danger">*</span></label>
                                            <div>
                                                <div wire:loading wire:target="thumbnail_image">Uploading...</div>
                                                <input wire:model="thumbnail_image" name="thumbnail_image" type="file" class="form-control" />
                                                @error('thumbnail_image') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                            @if ($thumbnail_image)
                                                <img src="{{ $thumbnail_image->temporaryUrl() }}" class="p-1 bg-primary" width="100" height="100">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input wire:model="title" type="text" class="form-control" name="title" required>
                                    @error('title') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">category <span class="text-danger">*</span></label>
                                            <select wire:model="category_id" class="form-control" name="category" required>
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Location <span class="text-danger">*</span></label>
                                            <select wire:model="location_id" class="form-control" name="location" required>
                                                <option value="">Select</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('location_id') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Address <span class="text-danger">*</span></label>
                                    <input wire:model="address" type="text" class="form-control" name="address" required>
                                    @error('address') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone <span class="text-danger">*</span></label>
                                            <input wire:model="phone" type="text" class="form-control" name="phone" required>
                                            @error('phone') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email <span class="text-danger">*</span></label>
                                            <input wire:model="email" type="text" class="form-control" name="email" required>
                                            @error('email') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Website <span class="text-danger"></span></label>
                                            <input wire:model="website" type="text" class="form-control" name="website">
                                            @error('website') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Facebook Link <span class="text-danger"></span></label>
                                            <input wire:model="facebook_link" type="text" class="form-control" name="facebook_link">
                                            @error('facebook_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">X Link <span class="text-danger"></span></label>
                                            <input wire:model="x_link" type="text" class="form-control" name="x_link">
                                            @error('x_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Linkedin Link <span class="text-danger"></span></label>
                                            <input wire:model="linkedin_link" type="text" class="form-control" name="linkedin_link">
                                            @error('linkedin_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Whatsapp Link <span class="text-danger"></span></label>
                                            <input wire:model="whatsapp_link" type="text" class="form-control" name="whatsapp_link">
                                            @error('whatsapp_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Attacement <span class="text-danger"></span></label>
                                            <input wire:model="file" type="file" class="form-control" name="file">
                                            @error('file') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div wire:ignore class="form-group">
                                    @if ($subscription->package->num_of_amenities === -1)
                                        <label>Amenities <code>( Unlimited )</code></label>
                                    @else
                                        <label>Amenities <code>( Maximum : {{ $subscription->package->num_of_amenities }} entry )</code></label>
                                    @endif

                                    <select wire:model="amenity" id="amenity" class="form-control select2" multiple="multiple" name="amenity[]">
                                        @foreach ($amenities as $amenity)
                                            <option value="{{ $amenity->id }}" >{{ $amenity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div wire:ignore class="form-group">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <textarea wire:model="description" name="description" class="form-control select2" id="description"></textarea>
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Google Map Embed Code <span class="text-danger"></span></label>
                                    <textarea wire:model="google_map_embed_code" name="google_map_embed_code" class="form-control"></textarea>
                                    @error('google_map_embed_code') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Seo Title <span class="text-danger"></span></label>
                                    <input wire:model="seo_title" type="text" class="form-control" name="seo_title">
                                    @error('seo_title') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Seo Description <span class="text-danger"></span></label>
                                    <textarea wire:model="seo_description" name="seo_description" class="form-control"></textarea>
                                    @error('seo_description') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Status <span class="text-danger">*</span></label>
                                            <select wire:model="status" name="status" class="form-control" required>
                                                <option selected="">Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Is Featured <span class="text-danger"></span></label>
                                            <select wire:model="is_featured" name="is_featured" class="form-control" required>
                                                <option selected="">Choose...</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            @error('is_featured') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <button type="submit" class="read_btn mt-4">Create</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        label {
            margin-top: 15px;
        }
    </style>
</div>
@script()
<script>
    // select2
    $(document).ready(function() {
        $('#amenity').select2();
        $('#amenity').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('amenity',data)
        });
    });

    // tiny editor
    tinymce.init({
        selector: '#description',
        forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
                @this.set('description', editor.getContent());
            });
        }
    });


</script>
@endscript
