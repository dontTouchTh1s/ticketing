<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Contracts\View\View;

class NotificationController extends Controller
{

    /**
     * Display a listing of notifications.
     *
     * @return View
     */
    public function __invoke()
    {
        $notifications = Notification::all();
        $notification_info = [];
        foreach ($notifications as $notification) {
            $type = match ($notification->type) {
                Notification::NOTIFICATION_TYPE_WARNING => 'اخطار',
                Notification::NOTIFICATION_TYPE_INFO => 'اطلاعیه',
                Notification::NOTIFICATION_TYPE_DANGER => 'خطر',
                default => 'uknow',
            };
            $notification_info[] = [
                'id' => $notification->id,
                'title' => $notification->title,
                'body' => $notification->body,
                'type' => $type
            ];
        }
        return view('notification.show_notification')
            ->with([
                'notifications' => $notification_info
            ]);
    }

}
