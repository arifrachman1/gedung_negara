<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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

    public function rolePermission(Request $request)
{
    $role = $request->get('role');
    
    //Default, set dua buah variable dengan nilai null
    $permissions = null;
    $hasPermission = null;
    
    //Mengambil data role
    $roles = Role::all()->pluck('name');
    
    //apabila parameter role terpenuhi
    if (!empty($role)) {
        //select role berdasarkan namenya, ini sejenis dengan method find()
        $getRole = Role::findByName($role);
        
        //Query untuk mengambil permission yang telah dimiliki oleh role terkait
        $hasPermission = DB::table('role_has_permissions')
            ->select('permissions.name')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id', $getRole->id)->get()->pluck('name')->all();
        
        //Mengambil data permission
        $permissions = Permission::all()->pluck('name');
    }
    return view('users.role_permission', compact('roles', 'permissions', 'hasPermission'));
}

}
