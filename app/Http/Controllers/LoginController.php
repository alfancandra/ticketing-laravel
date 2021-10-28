<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role_id==0) {
            return redirect() -> route('usr.home');
        } elseif (Auth::check() && Auth::user()->role_id==1) {
            return redirect() -> route('adm.dashboardadmin');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validasi data
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try{
            $akun = $request->only('username','password');
            if(Auth::attempt($akun)){
                $AuthUser = Auth::user();
                if(Auth::user()->role_id==1){
                    return redirect() -> route('adm.dashboardadmin');
                }else{
                    return redirect() -> route('home');
                }
            } else {
                return redirect() -> route('login') -> with(['error' => 'Wrong username or password!']);
            }
        }catch(QueryException $e){
            // return response()->json([
            //     'message' => "Failed " . $e->errorInfo
            // ]);
            return redirect() -> route('login') -> with(['error' => $e->errorInfo]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
