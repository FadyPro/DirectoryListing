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
                            <a href="{{ route('user.listing.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a>
                            <h4>Image Gallery ({{  $listingTitle->title }})</h4>
                            <form wire:submit.prevent="save">
                                @csrf
                                @foreach ($errors->all() as $message)
                                    <div class="alert alert-danger alert-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    @if ($subscription->package->num_of_photos === -1)
                                        <label class="mb-2" for="">Image <code> ( Unlimited )(Multi image supported)</code></label>
                                    @else
                                        <label class="mb-2" for="">Image <code> ( {{ $subscription->package->num_of_photos }} Images is max )(Multi image supported)</code></label>
                                    @endif

                                    <input type="file" wire:model="image" class="form-control" multiple accept="image/jpeg,image/jpg,image/png,image/gif">
                                    @error('image.*') <span class="error">{{ $message }}</span> @enderror

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="read_btn mt-4">Upload</button>
                                </div>
                            </form>
                        </div>

                        <div class="my_listing mt-4">
                            <h4>All Images</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($images as $image)
                                    <tr>
                                        <th scope="row">{{ ++$loop->index }}</th>
                                        <td>
                                            <img src="{{(!empty($image->image))? url('/uploads/listing/'.$image->image) : url('/uploads/no-image.png')}}"  width="100">
                                        </td>
                                        <td>
                                            <a href="javascript:;" wire:click.prevent="destroy({{$image->id}})" class="btn btn-sm btn-danger delete-item ml-2"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
