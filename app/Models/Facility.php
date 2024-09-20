<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\Role as RoleEnum;
class Facility extends Model

{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'facility_name',
        'bikou',
    ];
    
    //中間テーブルfacility_staffsと紐づける
    public function facility_staffs(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名'))
    return $this->belongsToMany(User::class, 'facility_staffs', 'facility_id', 'user_id')
    ->withTimestamps()
    ->withPivot('user_id');
    }
     // 中間テーブルpeople_facilitiesと紐づける
    public function people_facilities(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名'))
    return $this->belongsToMany(Person::class, 'people_facilities', 'facility_id', 'people_id')
    ->withTimestamps();
    }

    public function medicalCareNeeds()
{
    return $this->belongsToMany(MedicalCareNeed::class, 'medical_care_facilities', 'facility_id', 'medical_care_need_id');
}
    
}
