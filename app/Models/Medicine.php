<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table = 'medicines';
    protected $fillable = ['people_id','user_id_medicine','created_at','medicine','medicine_bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
