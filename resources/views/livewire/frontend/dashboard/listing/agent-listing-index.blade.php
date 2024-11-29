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
                            <h4 style="justify-content: space-between">My Listings
                                <a href="{{ route('user.listing.create') }}" class="btn btn-success"> Create</a>
                            </h4>
                            <div>
                                <div class="d-flex align-items-center ml-20" style="width: 150px">
                                    <label for="paginate" class="text-nowrap mr-2 mb-0">Per Page</label>
                                    <select wire:model.live="paginate" name="paginate" id="paginate" class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div>
                            <div style="padding-left: 55%;">
                                <form>
                                    <div class="input-group">
                                        <input wire:model.live="search" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button wire:click="Search" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12">
                                <div class="dashboard_content">
                                    <div class="my_listing p_xm_0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th style="width: 15%">Image</th>
                                                    <th wire:click="setSortBy('title')" style="cursor: pointer">
                                                        <a> Title
                                                            @if( $sortBy !== 'title')
                                                                <i class="fas fa-solid fa-arrow-up"></i>
                                                            @elseif( $sortBy === 'title' && $sortDirection === 'asc')
                                                                <i class="fas fa-solid fa-arrow-down"></i>
                                                            @else
                                                                <i class="fas fa-solid fa-arrow-up"></i>
                                                            @endif
                                                        </a>
                                                    </th>
                                                    <th>Category</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th style="width: 20%">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($model as $key=>$models)
                                                <tr>
                                                    <td> <img src="{{(!empty($models->image))? url('/uploads/listing/'.$models->image) : url('/uploads/no-image.png')}}"> </td>
                                                    <td>{{$models->title}}</td>
                                                    <td>{{$models->category->name}}</td>
                                                    <td>{{$models->location->name}}</td>
                                                    <td>
                                                            @if($models->status === 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @endif

                                                            @if($models->is_featured === 1)
                                                                <span class="badge bg-primary">Featured</span>
                                                            @endif

                                                            @if($models->is_verified === 1)
                                                                <span class="badge bg-info">Verified</span>
                                                            @endif
                                                            @if($models->is_approved === 0)
                                                                 <span class="badge bg-warning">Pending</span>
                                                            @endif
                                                    </td>
                                                    <td>
                                                        <a href="/user/listing/{{$models->id}}/edit"  class="btn btn-sm btn-primary"><i class='fas fa-edit'></i></a>
                                                        <a href="javascript:;" wire:click.prevent="deleteOne({{$models->id}})" class="btn btn-danger btn-sm delete-item ml-2"><i class='fas fa-trash'></i></a>
                                                        <div class="dropdown">
                                                            <button class="btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-cog"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" href="/user/listing-image-gallery/{{$models->id}}">Image Gallery</a></li>
                                                                <li><a class="dropdown-item" href="/user/listing-video-gallery/{{$models->id}}">Video Gallery</a></li>
                                                                <li><a class="dropdown-item" href="/user/listing-schedule/{{$models->id}}">Schedule</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if (count($model) === 0)
                                                <p> ... showing no Results found </p>
                                            @endif
                                            <div>
                                                <br>
                                                {{$model->onEachSide(2)->links()}}
                                            </div>
                                            <div>
                                                Viewing {{ $model->firstItem() }} - {{ $model->lastItem() }} of {{ $model->total() }} entries
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        span{
            color: red;
        }
    </style>
</div>
