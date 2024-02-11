<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $fillable = ['people_id','filename','path'];
    // リレーションシップを定義するときに外部キーのカラム名を指定する
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}
