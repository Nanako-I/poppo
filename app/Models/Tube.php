<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tube extends Model
{
    use HasFactory;
    protected $table = 'tubes';
    protected $fillable = ['people_id','user_id_tube','created_at_tube','tube','tube_bikou','user_id_medicine','created_at_medicine','medicine','medicine_bikou','filename','path'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
