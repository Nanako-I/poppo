<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCareNeed extends Model
{
    use HasFactory;

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'medical_care_facilities', 'medical_care_need_id', 'facility_id');
    }
}
