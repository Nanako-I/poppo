<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloodpressure extends Model
{
    use HasFactory;
    protected $table = 'bloodpressures';
    protected $fillable = ['people_id','max_blood','min_blood','bikou', 'pulse', 'spo2','created_at'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
