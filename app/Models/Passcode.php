<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passcode extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'passcode', 'expires_at'];

    protected $dates = ['expires_at'];
}
