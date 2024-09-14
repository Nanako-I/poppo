<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';
    protected $fillable = ['people_id','user_name','user_identifier','message','filename','path','created_at','updated_at','is_read'];

    // チャットが所属するPerson
    public function person()
    {
        return $this->belongsTo(Person::class, 'people_id');
    }

    // 未読メッセージを取得するスコープ
    public function scopeUnread($query, $userId)
    {
        return $query->where('is_read', false)
                     ->where('user_identifier', '!=', $userId);
    }

    // ユーザ名とメッセージを取得するスコープ
    public function scopeGetData($query)
    {
        return $this->created_at . ' @' . $this->user_name . ' ' . $this->message;
    }

}