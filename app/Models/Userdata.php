<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Userdata extends Authenticatable
{

    protected $fillable = ['username','password'];
    use HasFactory;
}
