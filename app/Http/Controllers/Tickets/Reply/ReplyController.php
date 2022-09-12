<?php

namespace App\Http\Controllers\Tickets\Reply;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reply\StoreReplyRequest;
use App\Models\Customer;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Request;

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
                'content' => $reply->content,
                'id' => $reply->id,
                'created_date' => $reply->created_at->toDateString(),
                'created_time' => $reply->created_at->toTimeString()

            ];
        }
        return view('tickets.replies.show_ticket_replies')
            ->with([
                'ticket' => $tickets_info,
                'replies' => $repliesInfo
            ]);
    }

    /**
     * Display a listing of the ticket replies.
     * @param StoreReplyRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReplyRequest $request)
    {
        $data = $request->validated();
        $reply = [
            'ticket_id' => $data['ticket'],
            'replyable_id' => Auth::user()->id,
            'replyable_type' => Auth::user()::class,
            'content' => $data['content'],
            'rate' => 0,
            'ip' => Request::ip()
        ];
        Reply::create($reply);
        return redirect()->back();
    }
}
