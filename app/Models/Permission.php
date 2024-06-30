<?php

namespace App\Models;

use App\Enums\PermissionType as PermissionEnum;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public function getDescriptionAttribute(): string
    {
        $name = $this->name;
        $description = PermissionEnum::getDescription($name);

        return $description !== '' ? $description : $name;
    }

    public function isSystemDefined(): bool
    {
        return PermissionEnum::hasValue($this->name);
    }
}
