<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportableController extends Controller
{
    /**
     * Get reportable object information and return them, reportable can be ticket or reply
     * @params Request
     * @return JsonResponse
     */
    public function getReportableInfo(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'type' => 'required'
        ]);
        if ($data['type'] == 'App\Models\Ticket') {
            $ticket = Ticket::find($data['id']);
            $info = [
                'type' => 'ticket',
                'content' => $ticket->content,
                'sender' => $ticket->customer()->first()->name,
                'manage_ticket' => route('tickets.manage', [$ticket->id]),
                'manage_sender' => '/#profile',
            ];
        } else {
            $reply = Reply::find($data['id']);
            $ticket = $reply->ticket()->first();
            $info = [
                'type' => 'reply',
                'content' => $reply->content,
                'sender' => $reply->replyable()->first()->name,
                'manage_ticket' => route('replies', [$ticket->id]),
                'manage_sender' => '/#profile'
            ];
        }
        return response()->json($info);
    }
}
