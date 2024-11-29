<div>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.location.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="">Settings</a></div>
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
                                            <a class="nav-link active" href="{{route('admin.settings.general')}}" role="tab" aria-controls="home" aria-selected="true">General Settings</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.settings.logo')}}" role="tab" aria-controls="contact" aria-selected="false">Logo and Favicon Settings</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link"  href="{{route('admin.settings.pusher')}}" role="tab" aria-controls="profile" aria-selected="false">Pusher Settings</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link"   href="{{route('admin.settings.appearance')}}" role="tab" aria-controls="appearace-settings" aria-selected="false">Appearance Settings</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10">
                                    <div class="tab-content no-padding" id="myTab2Content">
                                        <div class="card border">
                                            <div class="card-body">
                                                <form wire:submit.prevent="updateGeneralSettings">
                                                    @csrf
                                                    <div class="row">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Site Name</label>
                                                                <input wire:model="site_name" name="site_name" type="text" class="form-control" value="{{config('settings.site_name')}}">
                                                                @error('site_name') <span class="error">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Site Email</label>
                                                                    <input wire:model="site_email" name="site_email" type="text" class="form-control" value="{{config('settings.site_email')}}">
                                                                    @error('site_email') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Site Phone</label>
                                                                    <input wire:model="site_phone" name="site_phone" type="text" class="form-control" value="{{config('settings.site_phone')}}">
                                                                    @error('site_phone') <span class="error">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                        <div class="col-md-12">
                                                            <div wire:ignore class="form-group">
                                                                <label for="">Site Time Zone</label>
                                                                <select wire:model="site_timezone"  name="site_timezone" id="site_timezone" class="form-control select2">
                                                                    <option value="">Select</option>
                                                                    <option value="UTC">UTC</option>
                                                                    @foreach (config('time-zone') as $key => $timezone)
                                                                        <option @selected($key === config('settings.site_timezone')) value="{{ $key }}">{{ $key }} - {{ $timezone }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('site_timezone') <span class="error">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div wire:ignore class="form-group">
                                                                <label for="">Site Default Currency</label>
                                                                <Select wire:model="site_default_currency" name="site_default_currency" id="site_default_currency" class="form-control select2">
                                                                    <option value="">Select</option>
                                                                    @foreach (config('currencies.currency_list') as $key => $currency)
                                                                        <option @selected($currency === config('settings.site_default_currency')) value="{{ $currency }}">{{ $key }} ({{ $currency }})</option>
                                                                    @endforeach
                                                                </Select>
                                                                @error('site_default_currency') <span class="error">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Site Currency Icon</label>
                                                                <input wire:model="site_currency_icon" type="text" class="form-control" name="site_currency_icon" value="{{ config('settings.site_currency_icon') }}">
                                                                @error('site_currency_icon') <span class="error">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div wire:ignore class="form-group">
                                                                <label for="">Site Currency Position</label>
                                                                <Select wire:model="site_currency_icon_position" name="site_currency_icon_position" id="site_currency_icon_position" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option @selected(config('settings.site_currency_position') === 'left') value="left" >Left</option>
                                                                    <option @selected(config('settings.site_currency_position') === 'right') value="right">Right</option>
                                                                </Select>
                                                                @error('site_currency_icon_position') <span class="error">{{ $message }}</span> @enderror
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
    </section>
</div>
@script()
<script>
    // select2
    $(document).ready(function() {
        $('#site_default_currency').select2();
        $('#site_default_currency').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('site_default_currency',data)
        });
    });
    // select2
    $(document).ready(function() {
        $('#site_currency_icon_position').select2();
        $('#site_currency_icon_position').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('site_currency_icon_position',data)
        });
    });
    // select2
    $(document).ready(function() {
        $('#site_timezone').select2();
        $('#site_timezone').on('change',function (){
            let data = $(this).val()
            console.log(data)
            $wire.set('site_timezone',data)
        });
    });
</script>
@endscript
