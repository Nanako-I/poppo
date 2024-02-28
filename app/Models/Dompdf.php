<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dompdf extends Model
{
   use HasFactory;
    protected $table = 'pdfs';
    protected $fillable = ['people_id','hanko_name','kiroku_date'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}