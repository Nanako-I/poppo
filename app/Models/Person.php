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
        // return $this->belongsToMany('App\Models\User');
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
    
    public function videos()
    {
        return $this->hasMany(Video::class,'people_id');
        //  return $this->hasMany(Temperature::class);
    }
}