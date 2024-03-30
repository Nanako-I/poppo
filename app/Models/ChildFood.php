<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildFood extends Model
{
    use HasFactory;
    protected $table = 'child_foods';
    protected $fillable = ['people_id','food_created_at','oyatsu','created_at'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
