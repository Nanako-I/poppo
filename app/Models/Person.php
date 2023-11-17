<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $fillable = ['person_name','date_of_birth' , 'gender','jukyuusha_number', 'kubun_number','profile_image','filename','path'];
// 体温一覧リスト↓
    public function temperatures()
    {
        return $this->hasMany(Temperature::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }

public function foods()
    {
        return $this->hasMany(Food::class,'people_id');
    }
    
    public function toilets()
    {
        return $this->hasMany(Toilet::class,'people_id');
    }
    
    public function speeches()
    {
        return $this->hasMany(Speech::class,'people_id');
    }
    
}