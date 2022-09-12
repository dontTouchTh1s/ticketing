<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeDepartemntTicketRequest;
use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ManageTicketController extends Controller
{
    public function index(Ticket $ticket)
    {
        $tickets_info = ['id' => $ticket->id,
            'subject' => $ticket->subject,
            'content' => $ticket->content,
            'priority' => $ticket->priority,
            'active' => $ticket->active ? "فعال" : "غیرفعال",
            'customer' => $ticket->customer()->first()->name,
            'service' => $ticket->service()->first()->title,
            'department' => $ticket->department()->first()->name];
        $departments = Department::all();
        return view('tickets.manage_ticket')->with([
            'ticket' => $tickets_info,
            'departments' => $departments
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChangeDepartemntTicketRequest $request
     * @return RedirectResponse
     */
    public function change_department(ChangeDepartemntTicketRequest $request)
    {
        $data = $request->validated();
        $ticket = Ticket::find($data['ticket']);
        $ticket->department_id = $data['department'];
        $ticket->save();
        return redirect()->back();
    }

    /**
     * Deactivate ticket in storage
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function deactivate(Request $request)
    {
        $ticket = Ticket::find($request->input('ticket'));
        $ticket->active = false;
        $ticket->save();
        return redirect()->back();
    }
}
