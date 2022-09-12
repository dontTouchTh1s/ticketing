<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;

class DeleteNotificationController extends Controller
{
    /**
     * Destroy notification row from databse
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function destroy(Notification $notification)
    {
        return redirect()->back();
    }
}
