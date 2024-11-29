<?php

namespace App\Livewire\Frontend\Dashboard;

use App\Models\Listing;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

#[Layout('layouts.frontend.master')]
class UserDashboardIndex extends Component
{
    public function render()
    {
        $subscription = Subscription::with('package')->where('user_id', auth()->user()->id)->first();
        $listingCount = Listing::where('user_id', auth()->user()->id)->count();
        $pendingListingCount = Listing::where('user_id', auth()->user()->id)->where('is_approved', 0)->count();
        $activeListingCount = Listing::where('user_id', auth()->user()->id)->where('is_approved', 1)->count();
        return view('livewire.frontend.dashboard.user-dashboard-index', compact('subscription', 'listingCount', 'pendingListingCount', 'activeListingCount'));
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect('/');
    }
}
