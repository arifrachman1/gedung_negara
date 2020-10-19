<?php

namespace App\Http\Controllers;

// use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index()    {
        $role = Role::orderBy('created_at', 'DESC')->paginate(10);
        return view('role/master_role', compact('role'));
    }
}
