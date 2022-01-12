<?php

namespace App\Http\Controllers\API\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUser()
    {
        $data = User::all();
        return $data;
    }
}
