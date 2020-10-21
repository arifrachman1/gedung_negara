<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    // public function __construct() 
    // {
    //     $this->middleware('role:admin');
    // }
    public function index()    {
        $roles = Role::orderBy('created_at', 'DESC')->paginate(10);
        // $permissions = Permission::all();
        return view('role/master_role', compact('roles'));
    }

    public function addRole() 
    {        
        $role = Role::get();
        return view('role/tambah_role', compact('role'));
    }

    public function Add(Request $request){
        $input = $request->all();
        // dd($input); 
        $data = new Role;     
        $data->name = $request->nama;
        $data->guard_name = $request->guard_name;
        $data->save();
        $user = Auth::user();
        return redirect()->route('role.update', ['id'=> $data->id]);
    }

    public function detail(Request $request, $id)
    {
        $role = Role::find($id);
        // $role->revokePermissionTo('role.create');
        $user = Auth::user();
        // dd($user->hasRole('admin'));
        $permissions = Permission::select('*')->where('category','=', 'role')->get();
        $masteruser = Permission::select('*')->where('category','=', 'users')->get();
        $mastergedung = Permission::select('*')->where('category','=', 'gedung')->get();
        $mastersatuan = Permission::select('*')->where('category','=', 'satuan')->get();
        $masterkomponen = Permission::select('*')->where('category','=', 'komponen')->get();
        $masterkerusakan = Permission::select('*')->where('category','=', 'kerusakan')->get();
        $masterpengaturan = Permission::select('*')->where('category','=', 'pengaturan')->get();
        $excel = Permission::select('*')->where('category','=', 'other')->get();
        return view('role/detail', compact('role','permissions','masteruser','mastergedung','mastersatuan','masterkomponen','masterkerusakan','masterpengaturan','excel'));
    }
    
    public function givePermission(Request $request, $id)
    {
        // dd($request->hasPermissions);
        $role = Role::find($id);
        $role->name = $request->nama;
        $role->save();
        $role->syncPermissions($request->hasPermissions);

        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> Permission diupdate']);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        // $role->revokePermissionTo('role.create');
        $user = Auth::user();
        // dd($user->hasRole('admin'));
        $permissions = Permission::select('*')->where('category','=', 'role')->get();
        $masteruser = Permission::select('*')->where('category','=', 'users')->get();
        $mastergedung = Permission::select('*')->where('category','=', 'gedung')->get();
        $mastersatuan = Permission::select('*')->where('category','=', 'satuan')->get();
        $masterkomponen = Permission::select('*')->where('category','=', 'komponen')->get();
        $masterkerusakan = Permission::select('*')->where('category','=', 'kerusakan')->get();
        $masterpengaturan = Permission::select('*')->where('category','=', 'pengaturan')->get();;
        $excel = Permission::select('*')->where('category','=', 'other')->get();
        return view('role/edit_role', compact('role','permissions','masteruser','mastergedung','mastersatuan','masterkomponen','masterkerusakan','masterpengaturan','excel'));
    }

    public function delete(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $role->delete();
        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> Dihapus']);
    }

}
