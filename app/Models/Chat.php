<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';
    protected $fillable = ['people_id','user_name','user_identifier','message','filename','path','created_at','updated_at'];
    
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }
    
    public function scopeGetData($query)
    {
        return $this->created_at . '　@' . $this->user_name . '　' . $this->message;
    }

}