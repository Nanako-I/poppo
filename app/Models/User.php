<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    // laravel permissionを使うための記述↓
    use Notifiable,HasRoles;
    
        
public function people(): BelongsToMany
    {
        // return $this->belongsToMany('App\Models\Person');
        
        // 関連づけられたモデルのクラス名（Person::class）が渡される　'families'という中間テーブルの名前を指定↓
        return $this->belongsToMany(Person::class, 'families')
        
        // relationshipという名前の中間テーブルの追加のカラムを指定↓
        ->withPivot('relationship')
        // 中間テーブルに関連づけるためのFamilyモデルが指定↓
        ->using(Family::class);
    }
    
    public function temperatures()
    {
        return $this->hasMany(Temperature::class,'user_id');
    }
    
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
}



