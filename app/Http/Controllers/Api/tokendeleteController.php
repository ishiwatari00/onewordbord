<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tokensave;

class tokendeleteController extends Controller
{
    public function tokendelete()
    {
        $now = now()->format("Y-m-d H:i:s");
        Tokensave::where('timelimit', '<', $now)->delete();
        
    }
}
