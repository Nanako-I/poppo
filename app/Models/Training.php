<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $table = 'trainings';
    protected $fillable = ['people_id','communication','exercise','reading_writing', 'calculation', 'homework', 'shopping', 'training_other', 'training_other_sentence'];
public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
