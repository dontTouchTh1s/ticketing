<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\UpdateNotificationRequest;
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
    public function edit(Notification $notification)
    {
        $type = match ($notification->type) {
            Notification::NOTIFICATION_TYPE_WARNING => 'اخطار',
            Notification::NOTIFICATION_TYPE_INFO => 'اطلاعیه',
            Notification::NOTIFICATION_TYPE_DANGER => 'خطر',
            default => 'uknow',
        };
        $notification_info = [
            'id' => $notification->id,
            'title' => $notification->title,
            'body' => $notification->body,
            'type' => $type
        ];

        return view('notification.edit_notification')->with([
            'notification' => $notification_info
        ]);
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
