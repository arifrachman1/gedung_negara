<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ModelHasRole;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

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
        
    }

    public function index() {
        $user = User::get();
        return view('User/master_user', compact('user'));
    }

    public function inputUser() {
        $role = Role::get();
        return view('User/tambah_user', compact('role'));
    }

    public function inputUserPost(Request $request) {
        $input = new User;
        $input->name = $request->name;
        $input->email = $request->email;
        $input->password = bcrypt($request->password);
        $input->assignRole($request->role);
        $input->save();
        return redirect('masteruser');
    }

    public function editUser($id) {
        $role = Role::get();
        $model = ModelHasRole::where('model_id', $id)->first();
        $edit = User::find($id);
        return view('User/edit_user', compact('edit', 'role', 'model'));
    }

    public function editUserPost($id, Request $request) {
        $update = User::find($id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->assignRole($request->role);
        //$update->password = $request->password;
        $update->update();
        return redirect('masteruser');
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('masteruser');
    }

}
