<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lifestyle extends Model
{
    use HasFactory;
    protected $table = 'lifestyles';
    
    protected $fillable = ['people_id','baggage','clean','other','bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
