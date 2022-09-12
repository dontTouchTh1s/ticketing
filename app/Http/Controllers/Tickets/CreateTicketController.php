<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Department;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateTicketController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTicketRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();
        $ticket = [
            'service_id' => $validated['service_id'],
            'customer_id' => '2',
            'department_id' => $validated['department_id'],
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'active' => true,
            'priority' => 1,
            'ip' => Request::ip(),
        ];
        Ticket::create($ticket);
        return redirect()->route('tickets.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $departments = Department::all();
        $services = Service::all();

        return view('tickets.create_ticket')
            ->with([
                'services' => $services,
                'departments' => $departments
            ]);
    }
}
