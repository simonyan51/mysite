<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class AdminController extends Controller
{
    public function index() {
    	return view("/admin.dashboards.dashboard1");
    }
    public function simpleTable() {
    	return view("/admin.tables.simple");
    }

    public function logout() {
    	Auth::logout();
    	Session::flush();
    	return redirect('/login');
    }
}
