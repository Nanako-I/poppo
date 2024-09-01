<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomID extends Model
{
   use HasFactory;
    protected $table = 'custom_ids';
    protected $fillable = ['custom_id','facility_id'];
    
    // public function person()
    // {
    //     return $this->belongsTo(Person::class, 'people_id');
    // }
    
    
}