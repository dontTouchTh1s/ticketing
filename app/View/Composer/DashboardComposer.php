<?php

namespace App\View\Composer;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardComposer
{
    protected Authenticatable|null|User $currentUser;

    public function __construct()
    {
        $this->currentUser = Auth::user();
    }

    public function compose(View $view)
    {
        $view->with('user', $this->currentUser);
    }
}
