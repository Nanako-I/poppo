<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\Role as RoleEnum;

class Person extends Model
{
    use HasRoles;
    use HasFactory;
    protected $table = 'people';
    protected $fillable = ['person_name','date_of_birth' , 'gender','jukyuusha_number', 'kubun_number','profile_image','filename','path'];
    
    
    //中間テーブルuser_rolesテーブルと紐づける↓
    public function roles(): BelongsToMany
    {
      //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
    return $this->belongsToMany(User::class, 'user_roles', 'user_id', 'role_id')
    ->withTimestamps();
       
    }
    
    // 中間テーブルpeople_familyと紐づける↓
    public function people_family(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
    return $this->belongsToMany(User::class, 'people_families', 'person_id','user_id')
    ->withTimestamps();
    }
    
     // 中間テーブルpeople_facilitiesと紐づける↓
    public function people_facilities(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
    return $this->belongsToMany(Facility::class, 'people_facilities', 'people_id', 'facility_id')
    ->withTimestamps();
    }

   
    public function times()
    {
        return $this->hasMany(Time::class,'people_id');
        
    }

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

    public function foods()
    {
        return $this->hasMany(Food::class,'people_id');
    }
    
    public function waters()
    {
        return $this->hasMany(Water::class,'people_id');
    }
    
    public function medicines()
    {
        return $this->hasMany(Medicine::class,'people_id');
    }
    
    public function tubes()
    {
        return $this->hasMany(Tube::class,'people_id');
    }
    
    public function toilets()
    {
        return $this->hasMany(Toilet::class,'people_id');
    }
    
    public function kyuuins()
    {
        return $this->hasMany(Kyuuin::class,'people_id');
    }
    
    public function hossas()
    {
        return $this->hasMany(Hossa::class,'people_id');
    }
    
    public function speeches()
    {
        return $this->hasMany(Speech::class,'people_id');
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class,'people_id');
    }
    
    public function hogoshas()
    {
        return $this->hasMany(Hogosha::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }
    
    public function child_conditions()
    {
        return $this->hasMany(ChildCondition::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }
    
    public function child_temperatures()
    {
        return $this->hasMany(ChildTemperature::class,'people_id');
  
    }
    
    public function child_foods()
    {
        return $this->hasMany(ChildFood::class,'people_id');
  
    }
    
    public function child_toilets()
    {
        return $this->hasMany(ChildToilet::class,'people_id');
  
    }
    
    public function baths()
    {
        return $this->hasMany(Bath::class,'people_id');
  
    }
    
    
    public function chats()
    {
        return $this->hasMany(Chat::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }
    
    public function videos()
    {
        return $this->hasMany(Video::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }
}