<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\UpdateNotificationRequest;
use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public const NOTIFICATION_TYPE_DANGER = 0;
    public const NOTIFICATION_TYPE_INFO = 1;
    public const NOTIFICATION_TYPE_WARNING = 2;
    /**
     * Display a listing of notifications.
     *
     * @return View
     */
    public function __invoke()
    {
        $notifications = Notification::all();
        $notification_info = [];
        foreach ($notifications as $notification){
            $type = match ($notification->type) {
                $this::NOTIFICATION_TYPE_DANGER => 'اخطار',
                $this::NOTIFICATION_TYPE_INFO => 'اطلاعیه',
                $this::NOTIFICATION_TYPE_WARNING => 'خطر',
                default => 'uknow',
            };
            $notification_info[] = [
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
