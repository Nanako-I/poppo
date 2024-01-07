<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toilet extends Model
{
    use HasFactory;
    protected $table = 'toilets';
    
    protected $fillable = ['people_id','urine_amount','ben_condition','ben_amount','bentsuu','filename','bikou','urine','ben'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}