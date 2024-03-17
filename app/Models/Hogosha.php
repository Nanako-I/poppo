<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hogosha extends Model
{
    use HasFactory;
    protected $table = 'hogoshas';
    protected $fillable = ['people_id','condition','temperature_created_at','temperature','ben_created_at','ben_condition','urine_created_at','food_created_at','nyuuyoku','oyatsu','bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
