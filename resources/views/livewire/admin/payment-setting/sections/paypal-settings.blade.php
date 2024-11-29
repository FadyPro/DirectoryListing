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
                                            <a class="nav-link active"  href="{{route('admin.paypal-settings.index')}}" role="tab" aria-controls="home">Paypal Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"  href="{{route('admin.stripe-settings.index')}}" role="tab" aria-controls="profile">Stripe Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"  href="{{route('admin.razorpay-settings.index')}}" role="tab" aria-controls="contact">Razorpay Settings</a>
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
                                                                    <label for="">Paypal Status</label>
                                                                    <select wire:model="paypal_status" name="paypal_status" id="paypal_status" class="select2 form-control">
                                                                        <option selected="">Choose...</option>
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inactive</option>
                                                                    </select>
                                                                    @error('paypal_status') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div wire:ignore class="form-group">
                                                                    <label for="">Paypal Country</label>
                                                                    <select wire:model="paypal_country" name="paypal_country" id="paypal_country" class="select2 form-control" id="">
                                                                        <option selected="">Choose...</option>
                                                                        @foreach (config('countries') as $key => $country)
                                                                            <option value="{{ $key }}">{{ $country }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('paypal_country') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div wire:ignore class="form-group">
                                                                    <label for="">Paypal Currency</label>
                                                                    <select wire:model="paypal_currency" name="paypal_currency" id="paypal_currency" class="select2 form-control">
                                                                        <option value="">Choose...</option>
                                                                        @foreach (config('currencies.currency_list') as $currency)
                                                                            <option @selected(config('settings.site_default_currency') === $currency) value="{{ $currency }}">{{ $currency }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('paypal_currency') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Paypal Currency Rate (Per {{ config('settings.site_default_currency') }})</label>
                                                                    <input wire:model="paypal_currency_rate" type="text" class="form-control" name="paypal_currency_rate" value="{{ config('payment.paypal_currency_rate') }}">
                                                                    @error('paypal_currency') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Paypal Client Id</label>
                                                                    <input wire:model="paypal_client_id" type="text" class="form-control" name="paypal_client_id" value="{{ config('payment.paypal_client_id') }}">
                                                                    @error('paypal_client_id') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Paypal Secret Key</label>
                                                                    <input wire:model="paypal_secret_key" type="text" class="form-control" name="paypal_secret_key" value="{{ config('payment.paypal_secret_key') }}">
                                                                    @error('paypal_secret_key') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Paypal App Key</label>
                                                                    <input wire:model="paypal_app_key" type="text" class="form-control" name="paypal_app_key" value="{{ config('payment.paypal_app_key') }}">
                                                                    @error('paypal_app_key') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <div>
                                                                        <div wire:loading wire:target="paypal_image" style="color: red">Uploading...</div>
                                                                        <input wire:model="paypal_image" name="paypal_image" type="file" class="form-control" />
                                                                        @error('paypal_image') <span class="error">{{ $message }}</span> @enderror
                                                                    </div>
                                                                    @if ($paypal_image)
                                                                        <img src="{{ $paypal_image->temporaryUrl() }}" class="p-1" width="80" height="80">
                                                                    @else
                                                                        <img src="{{(!empty($paypal['paypal_image']))? url('/uploads/'.$paypal['paypal_image']) : url('/uploads/no-image.png')}}" style="width: 80px; height: 80px">
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
        $('#paypal_status').select2();
        $('#paypal_status').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('paypal_status',data)
        });
    });
    // // select2
    $(document).ready(function() {
        $('#paypal_country').select2();
        $('#paypal_country').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('paypal_country',data)
        });
    });
    // select2
    $(document).ready(function() {
        $('#paypal_currency').select2();
        $('#paypal_currency').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('paypal_currency',data)
        });
    });
</script>
@endscript
