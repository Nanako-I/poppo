<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildConditionUser extends Model
{
    use HasFactory;

    // PersonモデルとUserモデルの関連を定義
    public function users()
    {
        return $this->belongsToMany(User::class, 'people_families', 'person_id', 'user_id');
    }

    // PersonモデルとChildConditionモデルの関連を定義
    public function childConditions()
    {
        return $this->hasMany(ChildCondition::class, 'people_id');
    }
}

class ChildCondition extends Model
{
    use HasFactory;
    
    protected $table = 'child_conditions';
    protected $fillable = ['people_id', 'condition'];

    // ChildConditionモデルとPersonモデルの関連を定義
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
