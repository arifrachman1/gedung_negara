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
        $input->save();
        return redirect('masteruser');
    }

    public function editUser($id) {
        // $role =
        $edit = User::find($id);
        return view('User/edit_user', compact('edit'));
    }

    public function editUserPost($id, Request $request) {
        $update = User::find($id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->password = $request->password;
        $update->save();
        return redirect('masteruser');
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('masteruser');
    }

}
