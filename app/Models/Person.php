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
    
    public function bloodpressures()
    {
        return $this->hasMany(Bloodpressure::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }

public function activities()
    {
        return $this->hasMany(Activity::class,'people_id');
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
    
    public function notifications()
    {
        return $this->hasMany(Notification::class,'people_id');
    }
    public function chats()
    {
        return $this->hasMany(Chat::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }
    
    
    public function trainings()
    {
        return $this->hasMany(Training::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }
    public function lifestyles()
    {
        return $this->hasMany(Lifestyle::class,'people_id');
        
    }
    public function creatives()
    {
        return $this->hasMany(Creative::class,'people_id');
        
    }
    
    public function times()
    {
        return $this->hasMany(Time::class,'people_id');
        
    }
    
    public function pdfs()
    {
        return $this->hasMany(Dompdf::class,'people_id');
        
    }
    
}