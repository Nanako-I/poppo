<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\Role as RoleEnum;

class Role extends SpatieRole
{
  use HasFactory;
  protected $table = 'roles';
  protected $fillable = ['name', 'guard_name'];

  // user_roles中間テーブルと紐づける↓
  public function user_roles(): BelongsToMany
  {
    //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
    return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id')
      ->withTimestamps();
  }

  public function scopeNotSuperAdministrator($query)
  {
    return $query->where('name', '<>', RoleEnum::SuperAdministrator);
  }

  public function getDescriptionAttribute(): string
  {
    $name = $this->name;
    $description = RoleEnum::getDescription($name);

    return $description !== '' ? $description : $name;
  }

  public function isSystemDefined(): bool
  {
    return RoleEnum::hasValue($this->name);
  }

  public function isAdministrator(): bool
  {
    return $this->name === RoleEnum::Administrator;
  }

  public function isSuperAdministrator(): bool
  {
    return $this->name === RoleEnum::SuperAdministrator;
  }
}
