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
                                                    <th>Order ID</th>
                                                    <th>Package</th>
                                                    <th wire:click="setSortBy('created_at')" style="cursor: pointer">
                                                        <a> Date
                                                            @if( $sortBy !== 'created_at')
                                                                <i class="fas fa-solid fa-arrow-up"></i>
                                                            @elseif( $sortBy === 'created_at' && $sortDirection === 'asc')
                                                                <i class="fas fa-solid fa-arrow-down"></i>
                                                            @else
                                                                <i class="fas fa-solid fa-arrow-up"></i>
                                                            @endif
                                                        </a>
                                                    </th>
                                                    <th>Paid</th>
                                                    <th>Paid_in</th>
                                                    <th>Payment Method</th>
                                                    <th>Payment Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($model as $key=>$models)
                                                    <tr>
                                                        <td>{{$models->order_id}}</td>
                                                        <td>{{$models->package->name}}</td>
                                                        <td>{{date('d-m-Y', strtotime($models->created_at))}}</td>
                                                        <td>{{$models->base_amount .' '. $models->base_currency}}</td>
                                                        <td>{{$models->paid_currency}}</td>
                                                        <td>{{$models->payment_method}}</td>
                                                        <td>
                                                            @if($models->payment_status == 'completed')
                                                                <span class="badge bg-success">COMPLETED</span>
                                                            @elseif($models->payment_status == 'pending')
                                                                <span class="badge bg-warning">PENDING</span>
                                                            @else
                                                                <span class="badge bg-danger">{{$models->payment_status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="/user/order/{{$models->id}}/show"  class="btn btn-sm btn-primary"><i class='fas fa-eye'></i></a></td>
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
{{--                                                Viewing {{ $model->firstItem() }} - {{ $model->lastItem() }} of {{ $model->total() }} entries--}}
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
