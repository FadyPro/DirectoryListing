<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.amenity.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Amenity</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.amenity.index') }}">Amenity</a></div>
                <div class="breadcrumb-item">Create</div>

            </div>
        </div>
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Create Amenity</h4>

                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="form-group">
                            <label for="">Icon <span class="text-danger">*</span></label>
                            <div wire:ignore wire:model.live="icon" id="iconpicker"  role="iconpicker" data-align="left"
                                 data-selected-class="btn-primary"
                                 data-unselected-class=""
                                 name="icon" ></div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input wire:model="name" class="form-control" name="name">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize your icon picker here (assuming it's a third-party library)
            $('#iconpicker').iconpicker();

            // Listen to iconpicker events and update Livewire
            $('#iconpicker').on('change', function (e) {
                // Assuming the picker emits the icon's value, you can access it like this
                var selectedIcon = e.icon;
                // Manually update Livewire's property
                Livewire.dispatch('setIcon', { title: selectedIcon });
            });
        });
    </script>

</div>
