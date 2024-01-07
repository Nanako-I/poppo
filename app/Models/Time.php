<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $table = 'times';
    protected $fillable = ['people_id','date','start_time','end_time','school', 'pick_up', 'send'];
    
    protected $casts = [
    'start_time' => 'datetime:H:i',
    'end_time' => 'datetime:H:i',
];

    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
