<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
            'tickets' => $tickets_info
        ]);
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
