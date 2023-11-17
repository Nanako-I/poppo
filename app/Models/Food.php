<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
   use HasFactory;
    protected $table = 'food';
    protected $fillable = ['people_id','food','staple_food','side_dish','medicine','medicine_name','bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}