<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Family extends Pivot
{
    public function showTableName()
    {
        return Str::title(Str::replace('_', ' ', $this->table));
    }
    
}