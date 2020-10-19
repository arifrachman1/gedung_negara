<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function index() {
        $user = User::get();
        return view('User/master_user', compact('user'));
    }

    public function inputUser() {
       // $role = 
        return view('User/tambah_user');
    }

    public function inputUserPost(Request $request) {
        $input = new User;
        $input->name = $request->name;
        $input->email = $request->email;
        $input->password = $request->password;
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('masteruser');
    }

}
