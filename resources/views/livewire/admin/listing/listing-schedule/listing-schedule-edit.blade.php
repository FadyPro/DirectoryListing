<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('listing-schedule.index', $ListingSchedule->listing_id) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Listing Schedule</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('listing-schedule.index', $ListingSchedule->listing_id) }}">Listing Schedule</a></div>
                <div class="breadcrumb-item">Edit</div>

            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Schedule</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                @csrf
                                <div class="form-group">
                                    <label for="">Day<span class="text-danger">*</span></label>
                                    <select wire:model="day" name="day" class="form-control" required>
                                        <option value="">Choose</option>
                                        @foreach (listing_schedule() as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                    @error('day') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Start Time<span class="text-danger">*</span></label>
                                            <input wire:model="start_time" type="time" class="form-control" name="start_time">
                                            @error('start_time') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">End Time<span class="text-danger">*</span></label>
                                            <input wire:model="end_time" type="time" class="form-control" name="end_time">
                                            @error('end_time') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Status <span class="text-danger">*</span></label>
                                    <select wire:model="status" name="status" class="form-control" required>
                                        <option selected="">Choose...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status') <span class="error">{{ $message }}</span> @enderror
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
