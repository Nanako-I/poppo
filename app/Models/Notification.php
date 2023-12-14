<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['people_id','notification'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
    
    
}