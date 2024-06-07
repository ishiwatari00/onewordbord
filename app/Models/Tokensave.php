<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokensave extends Model
{
    protected $fillable = ['email','token','timelimit'];
    use HasFactory;
}
