<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'arrival_datetime',
        'exit_datetime',
        'visit_type_id',
        'notes'
    ];
}
