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
                                            <a class="nav-link active"  href="{{route('admin.stripe-settings.index')}}" role="tab" aria-controls="profile">Stripe Settings</a>
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
                                                                    <label for="">Stripe Status</label>
                                                                    <select wire:model="stripe_status" name="stripe_status" id="stripe_status" class="select2 form-control">
                                                                        <option selected="">Choose...</option>
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inactive</option>
                                                                    </select>
                                                                    @error('stripe_status') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div wire:ignore class="form-group">
                                                                    <label for="">Stripe Country</label>
                                                                    <select wire:model="stripe_country" name="stripe_country" id="stripe_country" class="select2 form-control" id="">
                                                                        <option selected="">Choose...</option>
                                                                        @foreach (config('countries') as $key => $country)
                                                                            <option value="{{ $key }}">{{ $country }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('stripe_country') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div wire:ignore class="form-group">
                                                                    <label for="">Stripe Currency</label>
                                                                    <select wire:model="stripe_currency" name="stripe_currency" id="stripe_currency" class="select2 form-control">
                                                                        <option value="">Choose...</option>
                                                                        @foreach (config('currencies.currency_list') as $currency)
                                                                            <option @selected(config('settings.site_default_currency') === $currency) value="{{ $currency }}">{{ $currency }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('stripe_currency') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Stripe Currency Rate (Per {{ config('settings.site_default_currency') }})</label>
                                                                    <input wire:model="stripe_currency_rate" type="text" class="form-control" name="stripe_currency_rate" value="{{ config('payment.stripe_currency_rate') }}">
                                                                    @error('stripe_currency_rate') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Stripe Publishable Key</label>
                                                                    <input wire:model="stripe_key" type="text" class="form-control" name="stripe_key" value="{{ config('payment.stripe_key') }}">
                                                                    @error('stripe_key') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">Stripe Secret Key</label>
                                                                    <input wire:model="stripe_secret_key" name="stripe_secret_key" type="text" class="form-control">
                                                                    @error('stripe_secret_key') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <div>
                                                                        <div wire:loading wire:target="stripe_image" style="color: red">Uploading...</div>
                                                                        <input wire:model="stripe_image" name="stripe_image" type="file" class="form-control" />
                                                                        @error('stripe_image') <span class="error">{{ $message }}</span> @enderror
                                                                    </div>
                                                                    @if ($stripe_image)
                                                                        <img src="{{ $stripe_image->temporaryUrl() }}" class="p-1" width="80" height="80">
                                                                    @else
                                                                        <img src="{{(!empty($stripe['stripe_image']))? url('/uploads/'.$stripe['stripe_image']) : url('/uploads/no-image.png')}}" style="width: 80px; height: 80px">
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
        $('#stripe_status').select2();
        $('#stripe_status').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('stripe_status',data)
        });
    });
    // // select2
    $(document).ready(function() {
        $('#stripe_country').select2();
        $('#stripe_country').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('stripe_country',data)
        });
    });
    // select2
    $(document).ready(function() {
        $('#stripe_currency').select2();
        $('#stripe_currency').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('stripe_currency',data)
        });
    });
</script>
@endscript
