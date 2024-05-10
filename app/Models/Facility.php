<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'facility_name',
        'bikou',
    ];
    
    // userモデルと紐づける（people_facilitiesの中間テーブルを認識）↓
    public function facility_staffs(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名'))
    return $this->belongsToMany(User::class, 'facility_staffs', 'facility_id', 'staff_id')
    ->withTimestamps()
    ->withPivot('staff_id');
    }
     // Personモデルと紐づける（people_facilitiesの中間テーブルを認識）↓
    public function people_facilities(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名'))
    return $this->belongsToMany(Person::class, 'people_facilities', 'facility_id', 'people_id')
    ->withTimestamps();
    }
    
}
