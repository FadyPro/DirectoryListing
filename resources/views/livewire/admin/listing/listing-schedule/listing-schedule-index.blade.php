<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.listing.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Listing Schedule</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Listing</div>
                <div class="breadcrumb-item">Listing Schedule</div>

            </div>
        </div>
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>All Schedules ( {{ $listingTitle->title }} )</h4>
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
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header-action" style="padding-left: 20px;" >
                        <a href="{{route('listing-schedule.create',$listing_id)}}" class="btn btn-primary" style="padding-left: 20px; text-align: right; float: right;">
                            New Item
                        </a>
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
                                <th>day</th>
                                <th>start_time</th>
                                <th>end_time</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                            @foreach($model as $key=>$models)
                                <tr>
                                    <td>
                                        <div>
                                            <input type="checkbox" value="{{$models->id}}" wire:model.live="checked" class="custom-checkbox custom-control">
                                        </div>
                                    </td>
                                    <td>{{$models->day}}</td>
                                    <td>{{date('h:i a', strtotime($models->start_time))}}</td>
                                    <td>{{date('h:i a', strtotime($models->end_time))}}</td>
                                    <td>
                                        @if($models->status === 1)
                                            <span class="badge badge-primary">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/listing-schedule/{{$models->id}}/edit"  class="btn btn-primary"><i class='fas fa-edit'></i></a>
                                        <a href="javascript:;" wire:click.prevent="deleteOne({{$models->id}})" class="btn btn-danger delete-item ml-2"><i class='fas fa-trash'></i></a>
                                        {{--                                        <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{$models->id}})" class="ms-3"><i class='bx bxs-trash'></i></a>--}}
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
