<div>
    <div class="dashboard_sidebar">
        <span class="close_icon"><i class="far fa-times"></i></span>
        <a href="dsahboard.html" class="dash_logo">
            <img src="{{(!empty(auth()->user()->avatar))? url('/uploads/profile/'.auth()->user()->avatar) : url('/uploads/avatar.png')}}" alt="user" class="img-fluid">
        </a>
        <ul class="dashboard_link">
            @if (auth()->user()->role === 'admin')
                <li><a class="" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-tachometer"></i>Admin Dashboard</a></li>

            @endif
            <li><a class="" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
            <li><a href="{{ route('user.listing.index') }}"><i class="fas fa-list-ul"></i> My Listing</a></li>
            <li><a href="{{ route('user.listing.create') }}"><i class="fal fa-plus-circle"></i> Create Listing</a></li>
{{--            <li><a href="{{ route('user.reviews.index') }}"><i class="far fa-star"></i> Reviews</a></li>--}}
            <li><a href="{{ route('user.order.index') }}"><i class="fal fa-notes-medical"></i> Orders</a></li>
{{--            <li><a href="{{ route('packages') }}"><i class="fal fa-gift-card"></i> Package</a></li>--}}
{{--            <li><a href="{{ route('user.messages') }}"><i class="far fa-comments-alt"></i> Messages</a></li>--}}
            <li><a href="{{ route('user.profile.index') }}"><i class="far fa-user"></i> My Profile</a></li>
            <li>

                <!-- Authentication -->
              <a href="javascript:void(0)" wire:click="logout"><i class="far fa-sign-out-alt"></i> Logout </a>

                </li>
        </ul>
    </div>
</div>
