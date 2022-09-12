<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UpdateNotificationController extends Controller
{
    /**
     * Show form to edit notification
     * @return Application|Factory|View
     */
    public function edit()
    {
        return view();
    }

    /**
     * Update notification in database
     * @param UpdateNotificationRequest $request
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        return redirect()->back();
    }
}
