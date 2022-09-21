<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const NOTIFICATION_TYPE_DANGER = 0;
    public const NOTIFICATION_TYPE_INFO = 1;
    public const NOTIFICATION_TYPE_WARNING = 2;
    protected $fillable = [
        'title',
        'body',
        'type',
    ];

    public function groups()
    {
        return $this->morphedByMany(Group::class, 'notifable');
    }

    public function services()
    {
        return $this->morphedByMany(Service::class, 'notifable');
    }

    public function customers()
    {
        return $this->morphedByMany(Customer::class, 'notifable');
    }
}
