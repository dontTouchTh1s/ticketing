<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Service;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('admin.tickets.show_tickets', ['tickets' => $tickets] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        $departments = Department::all();
        $department_info = [];
        foreach ($departments as $department)
        {
            array_push($department_info, $department->attributesToArray());
        }
        $services = Service::all();
        $service_info = [];
        foreach ($services as $service)
        {
            array_push($service_info, $service->attributesToArray());
        }

        return view('admin.tickets.create_ticket')
            ->with([
                'services' => $service_info,
                'departments' => $department_info]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\RedirectResponse
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
        return redirect()->route('ticket.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
