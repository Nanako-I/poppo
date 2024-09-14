<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Auth\Passwords\CanResetPassword;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\RoleType as RoleEnum;
use App\Notifications\CustomPasswordResetNotification;

class User extends Authenticatable
{
    // laravel permissionを使うための記述↓
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    // 中間テーブルpeople_familyと紐づける↓
    public function people_family(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'people_families', 'user_id', 'person_id')
            ->withTimestamps();
    }

    // 中間テーブルfacility_staffsと紐づける↓
    public function facility_staffs(): BelongsToMany
    {
        //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
        return $this->belongsToMany(Facility::class, 'facility_staffs', 'user_id', 'facility_id')
            ->withTimestamps();
    }

    
    public function roles()
    {
        // /↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }
    
   // 中間テーブルuser_rolesと紐づける↓

    public function user_roles(): BelongsToMany
    {
        //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')
            ->withTimestamps();
    }

    public function temperatures()
    {
        return $this->hasMany(Temperature::class, 'user_id');
    }

    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordResetNotification($token));
    }
   


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'custom_id',
        // 'role',
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