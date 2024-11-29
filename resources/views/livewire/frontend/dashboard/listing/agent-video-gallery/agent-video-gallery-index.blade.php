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
                            <h4>Video Gallery ({{  $listingTitle->title }})</h4>

                            <form wire:submit.prevent="save">
                                @csrf
                                @foreach ($errors->all() as $message)
                                    <div class="alert alert-danger alert-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    @if ($subscription->package->num_of_video === -1)
                                        <label for="">Video Url <code>( Unlimited )*</code></label>
                                    @else
                                        <label for="">Video Url <code>( {{ $subscription->package->num_of_video }} Videos is max )*</code></label>
                                    @endif
                                    <input wire:model="video_url" type="text" class="form-control" name="video_url">
                                    @error('video_url') <span class="error">{{ $message }}</span> @enderror

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="read_btn mt-4">Upload</button>
                                </div>
                            </form>
                        </div>

                        <div class="my_listing mt-4">
                            <h4>All Videos</h4>
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
                                            <a href="javascript:;" wire:click.prevent="destroy({{$video->id}})" class="btn btn-sm btn-danger delete-item ml-2"><i class='fas fa-trash'></i></a>
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
