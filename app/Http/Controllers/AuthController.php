<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\User;
 
 
class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('dashboard');
        }
        return view('login');
    }
 
    public function login(Request $request)
    {
        $rules = [
            'name'                 => 'required|string',
            'password'              => 'required|string'
        ];
 
        $messages = [
            'name.required'        => 'Username wajib diisi',
            'name.name'           => 'Username tidak valid',
            'password.required'     => 'kata sandi wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'name'     => $request->input('name'),
            'password'  => $request->input('password'),
        ];
 
        Auth::attempt($data);
 
        if (Auth::check()) {
            //Login Success
            return redirect()->route('dashboard');
        } else {
            //Login Fail
            Session::flash('error', 'Username atau kata sandi salah');
            return redirect()->route('login');
        }
    }
 
    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
 
 
}