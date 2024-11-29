<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Payment Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="">Payment Settings</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-2">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link"  href="{{route('admin.paypal-settings.index')}}" role="tab" aria-controls="home">Paypal Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"  href="{{route('admin.stripe-settings.index')}}" role="tab" aria-controls="profile">Stripe Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active"  href="{{route('admin.razorpay-settings.index')}}" role="tab" aria-controls="contact">Razorpay Settings</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10">
                                    <div class="tab-content no-padding" >
                                        <div aria-labelledby="home-tab4">
                                            <div class="card border">
                                                <div class="card-body">
                                                    <form wire:submit="save">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div wire:ignore class="form-group">
                                                                    <label for="">Razorpay Status</label>
                                                                    <select wire:model="razorpay_status" name="razorpay_status"  class="form-control">
                                                                        <option selected="">Choose...</option>
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inactive</option>
                                                                    </select>
                                                                    @error('razorpay_status') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div wire:ignore class="form-group">
                                                                    <label for="">Razorpay Country</label>
                                                                    <select wire:model="razorpay_country" name="razorpay_country" id="razorpay_country" class="form-control select2">
                                                                        <option selected="">Choose...</option>
                                                                        @foreach (config('countries') as $key => $country)
                                                                            <option value="{{ $key }}">{{ $country }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('razorpay_country') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div wire:ignore class="form-group">
                                                                    <label for="">Razorpay Currency</label>
                                                                    <Select wire:model="razorpay_currency" name="razorpay_currency" id="razorpay_currency" class="form-control select2">
                                                                        <option value="">Choose...</option>
                                                                        @foreach (config('currencies.currency_list') as $currency)
                                                                            <option @selected(config('settings.site_default_currency') === $currency) value="{{ $currency }}">{{ $currency }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('razorpay_currency') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Razorpay Currency Rate (Per {{ config('settings.site_default_currency') }})</label>
                                                                    <input wire:model="razorpay_currency_rate" type="text" class="form-control" name="razorpay_currency_rate" value="{{ config('payment.razorpay_currency_rate') }}">
                                                                    @error('razorpay_currency_rate') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Razorpay Key</label>
                                                                    <input wire:model="razorpay_key" type="text" class="form-control" name="razorpay_key" value="{{ config('payment.razorpay_key') }}">
                                                                    @error('razorpay_key') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Razorpay Secret Key</label>
                                                                    <input wire:model="razorpay_secret_key" type="text" class="form-control" name="razorpay_secret_key" value="{{ config('payment.razorpay_secret_key') }}">
                                                                    @error('razorpay_secret_key') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <div>
                                                                        <div wire:loading wire:target="razorpay_image" style="color: red">Uploading...</div>
                                                                        <input wire:model="razorpay_image" name="razorpay_image" type="file" class="form-control" />
                                                                        @error('razorpay_image') <span class="error">{{ $message }}</span> @enderror
                                                                    </div>
                                                                    @if ($razorpay_image)
                                                                        <img src="{{ $razorpay_image->temporaryUrl() }}" class="p-1" width="80" height="80">
                                                                    @else
                                                                        <img src="{{(!empty($razorpay['razorpay_image']))? url('/uploads/'.$razorpay['razorpay_image']) : url('/uploads/no-image.png')}}" style="width: 80px; height: 80px">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </form>
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

        </div>
    </section>
</div>
@script()
<script>
    // select2
    $(document).ready(function() {
        $('#razorpay_status').select2();
        $('#razorpay_status').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('razorpay_status',data)
        });
    });
    // // select2
    $(document).ready(function() {
        $('#razorpay_country').select2();
        $('#razorpay_country').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('razorpay_country',data)
        });
    });
    // select2
    $(document).ready(function() {
        $('#razorpay_currency').select2();
        $('#razorpay_currency').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('razorpay_currency',data)
        });
    });
</script>
@endscript
