<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildToilet extends Model
{
     use HasFactory;
    protected $table = 'child_toilets';
    protected $fillable = ['people_id','urine_created_at','ben_created_at','ben_condition','created_at'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
