<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name','guard_name'];
    
    // usersテーブルと紐づける↓
    public function user_roles(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
    return $this->belongsToMany(User::class, 'user_roles','role_id', 'user_id')
    ->withTimestamps();
    
    }

  
}