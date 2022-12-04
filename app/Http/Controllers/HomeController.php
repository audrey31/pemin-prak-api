<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $user = $request->user;

        return response()->json([
            'status' => 'Success',
            'message' => 'selamat datang ' . $user->nama,
        ],200);
    }
}