<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'content',
        'reportable_id',
        'reportable_type'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function reportable()
    {
        return $this->morphTo();
    }

    public function sender()
    {
        return $this->morphTo();
    }
}
