<div>
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.listing.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Listing Video Gallery</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.listing.index') }}">Listing</a></div>
                    <div class="breadcrumb-item">Video Gallery</div>

                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Video Gallery ( {{ $listingTitle->title }} )</h4>

                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="save">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Video Url <code>*</code></label>
                                        <input wire:model="video_url" type="text" class="form-control" name="video_url">
                                        @error('video_url') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
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
                                        <th scope="col">Url</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($videos as $video)
                                        <tr>
                                            <th scope="row">{{ ++$loop->index }}</th>
                                            <td>
                                                <img width="100px" src="{{ getYtThumbnail($video->video_url) }}" alt="">
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ $video->video_url }}">{{ $video->video_url }}</a>
                                            </td>
                                            <td>
                                                <a href="javascript:;" wire:click.prevent="destroy({{$video->id}})" class="btn btn-danger delete-item ml-2"><i class='fas fa-trash'></i></a>
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
