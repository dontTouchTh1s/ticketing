<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'replyable_id',
        'replyable_type',
        'content',
        'rate',
        'ip'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function replyable()
    {
        return $this->morphTo();
    }

}
