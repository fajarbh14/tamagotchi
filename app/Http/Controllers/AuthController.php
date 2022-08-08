<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function index()
    {   
        return view("login");
    }

    public function login(Request $request)
    {
        $credential = [
            'username'     => $request->username,
            'password'  => $request->password,
        ];

        $payload["status_code"] = 500;
        $payload["message"]     = "These credentials do not match our records.";

        if (Auth::attempt($credential)) {
            Auth::guard('web')->attempt($credential);

            $payload["status_code"] = 200;
            $payload["message"]     = "Successfully Login";
            $payload["redirect_to"] = url("/home");
        }
        return response()->json($payload);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/login');
    }
}
