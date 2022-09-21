<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\UpdateNotificationRequest;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Notification;
use App\Models\Service;
use Cassandra\Custom;
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
        $services_info = [];
        $groups_info = [];
        $customers_info = [];
        $types = [];

        foreach (Service::all() as $service) {
            $services_info[] = [
                'id' => $service->id,
                'title' => $service->title,
                'selected' => $this->containsS($notification, $service)

            ];
        }
        foreach (Group::all() as $group) {
            $groups_info[] = [
                'id' => $group->id,
                'title' => $group->title,
                'selected' => $this->containsG($notification, $group)
            ];
        }
        foreach (Customer::all() as $customer) {

            $customers_info[] = [
                'id' => $customer->id,
                'name' => $customer->name,
                'selected' => $this->containsC($notification, $customer)
            ];
        }
        foreach (Notification::all() as $notif)
            $types [] = [
                'id' => $notif->type,
                'title' => match ($notification->type) {
                    Notification::NOTIFICATION_TYPE_WARNING => 'اخطار',
                    Notification::NOTIFICATION_TYPE_INFO => 'اطلاعیه',
                    Notification::NOTIFICATION_TYPE_DANGER => 'خطر',
                    default => 'unknown',
                },
                'selected' => $notification->type == $notif->type
            ];

        return view('notification.create_notification')->with([
            'services' => $services_info,
            'groups' => $groups_info,
            'customers' => $customers_info,
            'types' => $types
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
        $data = $request->validated();

        $notification->title = $data['title'];
        $notification->body = $data['body'];
        $notification->type = $data['type'];
        $notification->customers()->sync($data['customers_id']);
        $notification->services()->sync($data['services_id']);
        $notification->groups()->sync($data['groups_id']);
        $notification->save();

        return redirect()->back();
    }

    /**
     * Check for if Notification contains customer or not
     * @param Notification $notification
     * @param Customer $customer
     * @return bool
     */
    private function containsC(Notification $notification, Customer $customer) : bool
    {
        if($notification->customers()->find($customer->id) != null)
            return true;
        else
            return false;
    }
    private function containsS(Notification $notification, Service $service){
        if($notification->services()->find($service->id) != null)
            return true;
        else
            return false;

    }
    private function containsG(Notification $notification, Group $group){
        if($notification->groups()->find($group->id) != null)
            return true;
        else
            return false;
    }
}
