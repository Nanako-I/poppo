<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    use HasFactory;
    protected $table = 'waters';
    protected $fillable = ['people_id','user_id_water','created_at','water','water_bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
