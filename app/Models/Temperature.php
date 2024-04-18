<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Temperature extends Model
// {
//     use HasFactory;
//     protected $table = 'temperature';
//     protected $fillable = ['people_id','temperature'];
    
//     public function person()
//     {
//         return $this->belongsTo(Person::class, 'people_id');
//     }
// }



// class Temperature extends Model
// {
//     protected $table = 'temperature';
    
//     protected $fillable = ['temperature', 'people_id'];
    
//     public function person()
//     {
//         return $this->belongsTo(Person::class);
//     }
// }

class Temperature extends Model
{
    protected $table = 'temperature';
    protected $fillable = ['people_id','temperature', 'bikou','created_at'];
    // リレーションシップを定義するときに外部キーのカラム名を指定する
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
}