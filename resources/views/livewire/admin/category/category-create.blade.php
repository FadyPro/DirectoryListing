<div>
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
        </div>
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Create Categories</h4>

                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="form-group">
                            <label for="">Image Icon</label>
                            <div>
                                <div>
                                    <div wire:loading wire:target="image_icon">Uploading...</div>
                                    <input wire:model="image_icon" name="image_icon" type="file" class="form-control" />
                                    @error('image_icon') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                @if ($image_icon)
                                    <img src="{{ $image_icon->temporaryUrl() }}" class="p-1 bg-primary" width="100" height="100">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Background</label>
                            <div>
                                <div>
                                    <div wire:loading wire:target="background_image">Uploading...</div>
                                    <input wire:model="background_image" name="background_image" type="file" class="form-control" />
                                    @error('background_image') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                @if ($background_image)
                                    <img src="{{ $background_image->temporaryUrl() }}" class="p-1 bg-primary" width="100" height="100">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input wire:model="name" class="form-control" name="name">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Show at Home</label>
                            <select wire:model="show_at_home" class="form-control">
                                <option selected="">Choose...</option>
                                <option value="1">Yes</option>
                                <option selected value="0">No</option>
                            </select>
                            @error('show_at_home') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select wire:model="status" class="form-control">
                                <option selected="">Choose...</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>
