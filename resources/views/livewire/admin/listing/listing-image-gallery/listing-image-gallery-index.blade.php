<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.listing.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Listing Image Gallery</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.listing.index') }}">Listing</a></div>
                <div class="breadcrumb-item">Image Gallery</div>

            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Image Gallery ( {{ $listingTitle->title }} ) </h4>

                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="save">
                                @csrf
                                <div class="form-group">
                                    <label for="">Image <code>(Multi image supported)</code></label>
                                    <input type="file" wire:model="image" class="form-control" multiple accept="image/jpeg,image/jpg,image/png,image/gif">
                                    @error('image.*') <span class="error">{{ $message }}</span> @enderror
                                    <br>
{{--                                    @if ($image)--}}
{{--                                        @foreach($image as $images)--}}
{{--                                            <img src="{{ $images->temporaryUrl() }}" class="p-1" width="70" height="70">--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Images </h4>

                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($images as $AllImage)
                                    <tr>
                                        <th scope="row">{{ ++$loop->index }}</th>
                                        <td>
                                            <img src="{{(!empty($AllImage->image))? url('/uploads/listing/'.$AllImage->image) : url('/uploads/no-image.png')}}"  width="100">
                                        </td>
                                        <td>
                                            <a href="javascript:;" wire:click.prevent="destroy({{$AllImage->id}})" class="btn btn-danger delete-item ml-2"><i class='fas fa-trash'></i></a>

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
