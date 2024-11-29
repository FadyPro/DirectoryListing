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
                            <a href="{{ route('user.listing-schedule.index', $listing_id) }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a>
                            <h4>Create Schedule</h4>

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
                                    <button type="submit" class="read_btn mt-4">Create</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
