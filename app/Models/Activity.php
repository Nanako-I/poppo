<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';
    
    protected $fillable = ['people_id','kadai','rest','self_activity_other','self_activity_bikou','recreation','region_exchange','group_activity_other','group_activity_bikou'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
