<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $ticket)
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'service_id',
        'department_id',
        'active',
        'priority',
        'ip',
        'subject',
        'content'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
