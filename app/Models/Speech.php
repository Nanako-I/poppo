<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    use HasFactory;
    protected $table = 'speech';
    protected $fillable = ['people_id','morning_activity','afternoon_activity'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}