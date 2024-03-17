<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCondition extends Model
{
    use HasFactory;
    protected $table = 'child_conditions';
    protected $fillable = ['people_id','condition'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
