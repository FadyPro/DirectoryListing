<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Hero</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Hero</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Hero</h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit="save">
                                @csrf
                                <div class="form-group">
                                    <label for="">Background</label>
                                    <div>
                                        <div>
                                            <div wire:loading wire:target="background">Uploading...</div>
                                            <input wire:model="background" name="background" type="file" class="form-control" />
                                            @error('background') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                        @if ($background)
                                            <img src="{{ $background->temporaryUrl() }}" class="p-1 bg-primary" width="100" height="100">
                                        @else
                                            <img src="{{(!empty($hero->background))? url('/uploads/'.$hero->background) : url('/uploads/background.png')}}" style="width: 100px; height: 100px">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input wire:model="title" type="text" class="form-control" name="title" value="{{ @$hero->title }}">
                                    @error('title') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Sub Title <span class="text-danger">*</span></label>
                                    <textarea wire:model="sub_title" name="sub_title" class="form-control">{{ @$hero->sub_title }}</textarea>
                                    @error('sub_title') <span class="error">{{ $message }}</span> @enderror
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
