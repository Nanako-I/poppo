<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bath extends Model
{
    use HasFactory;
    protected $table = 'baths';
    protected $fillable = ['people_id','kibou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
