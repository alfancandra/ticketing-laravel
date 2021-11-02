<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.users.index',compact('user'));
    }

    public function add()
    {
        return view('admin.users.add');
    }

    public function store(Request $request)
    {
        // Validasi data
        $this->validate(request(), [
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        // Store user data to database
        try {
            $register = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);

            return redirect()->route('adm.datauser')->with(['success' => 'Success membuat user']);
        } catch (QueryException $e) {
            return redirect()->route('adm.datauser')->with(['error' => $e->errorInfo]);
        }
    }

    public function changerole($id)
    {
        $user = User::find($id);
        $auth = Auth::user();
        if($user && $auth->id != $id){
            if($user->role_id==0){
                $role = 1;
            }else{
                $role = 0;
            }
            $user->role_id = $role;
            $user->update();
            return redirect()->route('adm.datauser')->with(['success' => 'Success Ubah role '.$user->username]);
        }else{
            return redirect()->route('adm.datauser')->with(['error' => 'Tidak Dapat ubah role diri sendiri ']);
        }
    }

    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        if($user){
            return view('admin.users.edit',compact('user'));
        }else{
            return redirect()->route('adm.datauser')->with(['error' => 'User Tidak ada']);
        }
    }

    public function update(Request $request)
    {

        // Validasi data
        $this->validate(request(), [
            'name' => 'required|max:255',
            'username' => 'required',
            'role_id' => 'required',
        ]);

        // Store user data to database
        try {
            $ceksameusername = User::where('id','!=',$request->user_id)
            ->where('username',$request->username)
            ->first();
            if($ceksameusername){
                return redirect()->back()->with(['error' => 'Username Sudah Dipakai Orang lain']);
            }else{
                if(!empty($request->password)){
                    $this->validate(request(), [
                        'password' => 'required|confirmed'
                    ]);
                }
                $user = User::find($request->user_id);
                $user->name = $request->name;
                $user->username = $request->username;
                $user->password = Hash::make($request->password);
                $user->role_id = $request->role_id;
                $user->update();

                return redirect()->route('adm.datauser')->with(['success' => 'Success Edit user']);
            }
        } catch (QueryException $e) {
            return redirect()->route('adm.datauser')->with(['error' => $e->errorInfo]);
        }
    }
}
