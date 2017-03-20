<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Genre;

class AddController extends Controller
{
    public function index() {
    	$genres = Genre::all();
    	return view('/admin.tables.movies.add_movie', ["genres" => $genres]);
    }
}
