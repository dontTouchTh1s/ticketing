<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;
use App\Models\Service;
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
        $services = Service::all();
        $services_info = [];
        foreach ($services as $service){
            $services_info[] = [
                'id' => $service->id,
                'title' =>$service->title,
            ];
        }
        return view('notification.create_notification')->with([
            'services' => $services_info
            ]);
    }

    /**
     * store new notification to database
     *
     * @param StoreNotificationRequest $ticket
     * @return RedirectResponse
     */
    public function store(StoreNotificationRequest $ticket)
    {
        $data = $ticket->validated();
        $notification = [
            'title' => $data['title'],
            'body' => $data['body'],
            'type' => $data['type']
        ];
        Notification::create($notification);
        return redirect()->back();
    }
}
