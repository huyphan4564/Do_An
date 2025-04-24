<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoanModel;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function AuthPage(){
        return view('auth.blank');
        // jajcaj
    }
}
