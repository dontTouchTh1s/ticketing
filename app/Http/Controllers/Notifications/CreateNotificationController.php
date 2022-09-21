<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\StoreNotificationRequest;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Notification;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateNotificationController extends Controller
{
    /**
     * store new notification to database
     *
     * @param StoreNotificationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNotificationRequest $request)
    {

        $data = $request->validated();

        $notification = new Notification();
        $notification->title = $data['title'];
        $notification->body = $data['body'];
        $notification->type = $data['type'];
        $notification->save();

        $notification->customers()->attach($data['customers_id']);
        $notification->services()->attach($data['services_id']);
        $notification->groups()->attach($data['groups_id']);
        $notification->save();

        return redirect()->back();
    }

    /**
     * Show form to create new notification
     * @return View
     */
    public function create()
    {
        $services_info = [];
        $groups_info = [];
        $customers_info = [];
        $types = [];

        foreach (Service::all() as $service) {
            $services_info[] = [
                'id' => $service->id,
                'title' => $service->title,
            ];
        }
        foreach (Group::all() as $group) {
            $groups_info[] = [
                'id' => $group->id,
                'title' => $group->title,
            ];
        }
        foreach (Customer::all() as $customer) {
            $customers_info[] = [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        }
        foreach (Notification::all() as $notification)
            $types [] = [
                'id' => $notification->type,
                'title' => match ($notification->type) {
                    Notification::NOTIFICATION_TYPE_WARNING => 'اخطار',
                    Notification::NOTIFICATION_TYPE_INFO => 'اطلاعیه',
                    Notification::NOTIFICATION_TYPE_DANGER => 'خطر',
                    default => 'unknown',
                }
            ];

        return view('notification.create_notification')->with([
            'services' => $services_info,
            'groups' => $groups_info,
            'customers' => $customers_info,
            'types' => $types
        ]);
    }
}
