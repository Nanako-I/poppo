<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Person extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $fillable = ['person_name','date_of_birth' , 'gender','jukyuusha_number', 'kubun_number','profile_image','filename','path'];
    
    
    // usersテーブルと紐づける↓
    public function users(): BelongsToMany
    {
  
        // familiesという中間テーブルを指定する↓
        return $this->belongsToMany(User::class, 'families')
        ->withPivot('relationship')
        ->using(Family::class);
        
        // （hasManyは、一対多（One-to-Many）のリレーションシップを表現）
    }

    // Person モデルに追加
// public function people()
// {
//     return $this->hasMany(Person::class, 'id'); // もし id 以外の外部キーがあれば変更する必要があります
// }

// public function people()
// {
//     //families テーブルの user_id カラムが users テーブルの外部キーに、person_id カラムが people テーブルの外部キー（テーブル同士を関連づけるためのキー（id））に対応
//     return $this->belongsToMany(Person::class, 'families', 'user_id', 'person_id')
//         ->withPivot('relationship');
// }

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