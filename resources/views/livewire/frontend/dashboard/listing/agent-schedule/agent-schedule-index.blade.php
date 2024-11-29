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
                            <h4 style="justify-content: space-between">Listing Schedule ({{ $listingTitle->title }})
                                <a href="{{ route('user.listing-schedule.create', $listing_id) }}" class="btn btn-success"> Create</a>
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
                                                    <th>day</th>
                                                    <th>start_time</th>
                                                    <th>end_time</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($model as $key=>$models)
                                                    <tr>
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
                                                            <a href="/user/listing-schedule/{{$models->id}}/edit"  class="btn btn-primary btn-sm"><i class='fas fa-edit'></i></a>
                                                            <a href="javascript:;" wire:click.prevent="deleteOne({{$models->id}})" class="btn btn-danger btn-sm delete-item ml-2"><i class='fas fa-trash'></i></a>
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


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
