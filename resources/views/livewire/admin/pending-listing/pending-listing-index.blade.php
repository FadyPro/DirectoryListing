<div>
    <section class="section">
        <div class="section-header">
            <h1>Pending Listing</h1>
        </div>
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 style="width: 150px">Pending Listing List</h4>
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
                    <div style="margin-left: 10px;" class=" pr-20">
                        @if ($checked)
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                With Checked ({{ count($checked) }})
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a href="#" class="dropdown-item" type="button"
                                   onclick="confirm('Are you sure you want to delete these Records?') || event.stopImmediatePropagation()"
                                   wire:click="deleteRecords()">
                                    Delete
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card-header-form" style="padding-left: 55%;">
                        <form>
                            <div class="input-group">
                                <input wire:model.live="search" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button wire:click="Search" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    <div class="custom-checkbox custom-control">
                                        <input wire:model.live="selectAll" type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Author</th>
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
                                <th>Status</th>
                                <th>is_featured</th>
                                <th>is_verified</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($model as $key=>$models)
                                <tr>
                                    <td>
                                        <div>
                                            <input type="checkbox" value="{{$models->id}}" wire:model.live="checked" class="custom-checkbox custom-control">
                                        </div>
                                    </td>
                                    <td> <img src="{{(!empty($models->image))? url('/uploads/listing/'.$models->image) : url('/uploads/no-image.png')}}"  width="60" height="60"> </td>
                                    <td>{{$models->category->name}}</td>
                                    <td>{{$models->location->name}}</td>
                                    <td>{{$models->user->name}}</td>
                                    <td style="width: 20%">{{$models->title}}</td>
                                    <td>
                                        <select class="form-control approve" wire:change="updateStatus({{$models->id}}, $event.target.value)">
                                            <option value="0">Pending</option>
                                            <option value="1">Approve</option>
                                        </select>
                                    </td>
                                    <td>
                                        @if($models->is_featured === 1)
                                            <span class="badge badge-primary">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($models->is_verified === 1)
                                            <span class="badge badge-primary">Yes</span>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/listing/{{$models->id}}/edit"  class="btn btn-primary"><i class='fas fa-edit'></i></a>
                                        <a href="javascript:;" wire:click.prevent="deleteOne({{$models->id}})" class="btn btn-danger delete-item ml-2"><i class='fas fa-trash'></i></a>
                                        {{--                                        <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{$models->id}})" class="ms-3"><i class='bx bxs-trash'></i></a>--}}
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn  ml-2 btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu dropleft" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="/listing-image-gallery/{{$models->id}}">Image Gallery</a>
                                                <a class="dropdown-item" href="/listing-video-gallery/{{$models->id}}">Video Gallery</a>
                                                <a class="dropdown-item" href="/listing-schedule/{{$models->id}}">Schedule</a>

                                            </div>
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
    </section>
</div>
@script()
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('statusUpdated', () => {
            alert('Status updated successfully!');
            // You can also refresh the data if needed
        });
    });
</script>
@endscript
