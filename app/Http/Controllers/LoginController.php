<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use Session;
class LoginController extends Controller
{
    //
    function loginPage(){
        return view('login_admin');
    }
    function registerPage(){
        return view('register_admin');
    }
    function registerProcess(Request $request){
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('errMsg', 'Password tidak sama');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        if ($validator->fails()) {
            # code...
            return redirect()->back()->with('errMsg', 'Data tidak valid!');
        }
        $count = DB::table('admin')->where('email' , '=', $request->email)->count();
        if ($count > 0) {
            
            return redirect()->back()->with('errMsg', 'Email telah dipakai');
        }
        $count = DB::table('admin')->insert([
             'email' => $request->email,
             'name' => $request->name,
             'password' => Hash::make($request->password)
        ]);
        return redirect()->route('loginPage')->with('successMsg', 'Sukses register admin!');
    }
    function loginProcess(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        $count = DB::table('admin')->where('email' , '=', $request->email)->count();
        if ($count < 1) {
            
            return redirect()->back()->with('errMsg', 'Email ini belum terdaftar');
        }
        $check = DB::table('admin')->where('email', '=', $request->email)->first();
        if (!Hash::check($request->password, $check->password)) {
            return redirect()->back()->with('errMsg', 'Password Salah');
        }
        $request->session()->put('id', $check->id);
        $request->session()->put('email', $check->email);
        return redirect()->route('dashboardPage');

    }
}
