<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeDepartemntTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Department;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $tickets_info = [];
        foreach ($tickets as $ticket) {
            $tickets_info[] = ['id' => $ticket->id,
                'subject' => $ticket->subject,
                'priority' => $ticket->priority,
                'active' => $ticket->active ? "فعال" : "غیرفعال",
                'customer' => $ticket->customer()->first()->name,
                'service' => $ticket->service()->first()->title,
                'department' => $ticket->department()->first()->name];
        }
        return view('tickets.show_tickets')->with([
            'user' => Auth::user(),
            'tickets' => $tickets_info
        ]);
    }

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
                'user' => Auth::user(),
                'services' => $services,
                'departments' => $departments
            ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     * @return Application|Factory|View
     */
    public function manage(Ticket $ticket)
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
            'user' => Auth::user(),
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

    public function deactivate(Request $request)
    {
        $ticket = Ticket::find($request->input('ticket'));
        $ticket->active = false;
        $ticket->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return RedirectResponse
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back();
    }
}
