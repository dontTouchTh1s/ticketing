<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
