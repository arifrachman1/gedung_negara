<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //class HomeController extends Controller

    public function index()
    {
        return view('dashboard');
    }
}
