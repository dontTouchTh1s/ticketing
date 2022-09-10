<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function replies()
    {
        return $this->morphMany(Reply::class, 'replyable');
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'sender');
    }
}
