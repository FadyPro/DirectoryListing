<?php

namespace App\Livewire\Frontend\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UserDashboardSidebar extends Component
{
    public function render()
    {
        return view('livewire.frontend.dashboard.user-dashboard-sidebar');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect('/');
    }
}
