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
     * @param StoreNotificationRequest $ticket
     * @return RedirectResponse
     */
    public function store(StoreNotificationRequest $ticket)
    {

        $data = $ticket->validated();
        $customers = [];
        foreach ($data['customers_id'] as $customer) {
            $customers[] = Customer::find($customer);
        }
        $services = [];
        foreach ($data['services_id'] as $service) {
            $services[] = Service::find($service);
        }
        $groups = [];
        foreach ($data['groups_id'] as $group) {
            $groups[] = Group::find($group);
        }

        $notification = new Notification();
        $notification->title = $data['title'];
        $notification->body = $data['body'];
        $notification->type = $data['type'];
        $notification->save();

        $notification->customers()->sync($data['customers_id']);
        $notification->services()->sync($data['services_id']);
        $notification->groups()->sync($data['groups_id']);
        $notification->save();

        return redirect()->back();
    }

    /**
     * Show form to create new notification
     * @return View
     */
    public function create()
    {
        $services = Service::all();
        $groups = Group::all();
        $customers = Customer::all();
        $services_info = [];
        $groups_info = [];
        $customers_info = [];

        foreach ($services as $service) {
            $services_info[] = [
                'id' => $service->id,
                'title' => $service->title,
            ];
        }
        foreach ($groups as $group) {
            $groups_info[] = [
                'id' => $group->id,
                'title' => $group->title,
            ];
        }
        foreach ($customers as $customer) {
            $customers_info[] = [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        }
        return view('notification.create_notification')->with([
            'services' => $services_info,
            'groups' => $groups_info,
            'customers' => $customers_info
        ]);
    }
}
