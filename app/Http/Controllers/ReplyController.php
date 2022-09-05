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
                'replies' => $repliesInfo
            ]);
    }
}
