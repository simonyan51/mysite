<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Genre;
use App\Movie;

class EditController extends Controller
{
    public function index($id) {
    	$movie = Movie::with('genres') -> where('id', $id) -> first();
    	$genres = Genre::all();
    	return view('/admin.tables.movies.edit_movie', ['movie' => $movie, 'genres' => $genres]);
    }
}
