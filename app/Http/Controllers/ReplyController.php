<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Display a listing of the ticket replies.
     *
     * @return View
     */
    public function index(Ticket $ticket)
    {
        $ticket = Ticket::find($ticket->id);
        $tickets_info = ['id' => $ticket->id,
            'subject' => $ticket->subject,
            'content' => $ticket->content,
            'priority' => $ticket->priority,
            'active' => $ticket->active ? "فعال" : "غیرفعال",
            'customer' => $ticket->customer()->first()->name,
            'service' => $ticket->service()->first()->title,
            'department' => $ticket->department()->first()->name];
        $replies = $ticket->replies()->get();

        $repliesInfo = [];
        foreach ($replies as $reply) {
            if ($reply->replyable_type == Customer::class)
                $style = "reply-from-customer";
            else
                $style = "reply-from-user";
            $sender = $reply->replyable()->first();

            $repliesInfo [] = [
                'justify' => $style,
                'sender' => $sender,

                'content' => $reply->content
            ];
        }
        return view('tickets.replies.show_ticket_replies')
            ->with([
                'user' => Auth::user(),
                'ticket' => $tickets_info,
                'replies' => $repliesInfo
            ]);
    }
}
