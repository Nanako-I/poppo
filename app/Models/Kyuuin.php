<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyuuin extends Model
{
    use HasFactory;
    protected $table = 'kyuuins';
    protected $fillable = ['people_id','kyuuin','bikou','filename','path','created_at'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
