<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildTemperature extends Model
{
    use HasFactory;
    protected $table = 'child_temperatures';
    protected $fillable = ['people_id','temperature'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
