<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $auth = Auth::attempt($request->only(['email', 'password']));

        if ($auth) {
            return response(Auth::user(), 200);
        }

        return response()->json([
            'error' => 'invalid_credentials'
        ], 403);
    }
}
