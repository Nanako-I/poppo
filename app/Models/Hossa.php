<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hossa extends Model
{
    use HasFactory;
    protected $table = 'hossas';
    protected $fillable = ['people_id','user_id_hossa','created_at','hossa','hossa_bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
