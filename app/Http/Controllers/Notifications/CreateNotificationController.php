<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateNotificationController extends Controller
{
    /**
     * Show form to create new notification
     * @return View
     */
    public function create()
    {
        return view();
    }

    /**
     * store new notification to database
     *
     * @param StoreNotificationRequest $ticket
     * @return RedirectResponse
     */
    public function store(StoreNotificationRequest $ticket)
    {
        return redirect()->back();
    }
}
