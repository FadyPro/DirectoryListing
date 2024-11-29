<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Packages</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Packages</a></div>
                <div class="breadcrumb-item">Update</div>

            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Package <span class="text-danger">(For Unlimited Quantity Use -1)</span></h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="store">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Package Type <span class="text-danger">*</span></label>
                                            <select wire:model="type" name="type" class="form-control">
                                                <option selected="">Choose...</option>
                                                <option value="free">Free</option>
                                                <option value="paid">Paid</option>
                                            </select>
                                            @error('type') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Package Name <span class="text-danger">*</span></label>
                                            <input wire:model="name" type="text" class="form-control" name="name">
                                            @error('name') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Package Price <span class="text-danger">*</span></label>
                                            <input wire:model="price" type="text" class="form-control" name="price">
                                            @error('price') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Number of Days <span class="text-danger">*</span></label>
                                            <input wire:model="number_of_days" type="text" class="form-control" name="number_of_days">
                                            @error('number_of_days') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Number of Listing <span class="text-danger">*</span></label>
                                            <input wire:model="num_of_listing" type="text" class="form-control" name="num_of_listing">
                                            @error('num_of_listing') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Number of Photos <span class="text-danger">*</span></label>
                                            <input wire:model="num_of_photos" type="text" class="form-control" name="num_of_photos">
                                            @error('num_of_photos') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Number of Videos <span class="text-danger">*</span></label>
                                            <input wire:model="num_of_video" type="text" class="form-control" name="num_of_video">
                                            @error('num_of_video') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Number of Amenities <span class="text-danger">*</span></label>
                                            <input wire:model="num_of_amenities" type="text" class="form-control" name="num_of_amenities">
                                            @error('num_of_amenities') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Number of Featured Listings <span class="text-danger">*</span></label>
                                            <input wire:model="num_of_featured_listing" type="text" class="form-control" name="num_of_featured_listing">
                                            @error('num_of_featured_listing') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Show at Home <span class="text-danger">*</span></label>
                                            <select wire:model="show_at_home" name="show_at_home" class="form-control">
                                                <option selected="">Choose...</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            @error('show_at_home') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
