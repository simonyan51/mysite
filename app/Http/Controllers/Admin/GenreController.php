<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Genre;


class GenreController extends Controller
{
    public function index() {
    	$genres = Genre::orderBy("id", "desc") -> paginate(5);
    	return view("/admin.tables.genres.genres", ["genres" => $genres]);
    }

    public function create(Request $request) {
    	$this -> validate($request, ["genre_name" => "required"]);
    	$genre = new Genre;
    	$genre -> genre = $request -> genre_name;
    	$genre -> save();

    	return redirect('/admin/tables/genres');
    }

    public function show($id) {
        $genre = Genre::find($id);
        $movies = Movie::with('genres') -> get();
        $selectedMovies = [];
        foreach($movies as $movie) {
            foreach($movie -> genres as $movieGenre) {
                if ($genre -> genre == $movieGenre -> genre) {
                    array_push($selectedMovies, $movie);
                }
            }
        }
        return view("/admin.tables.genres.genre_show", ["movies" => $selectedMovies, "selectedGenre" => $genre]);
    }
    
    public function update(Request $request, $id) {
    	$this -> validate($request, ['genre_name' => 'required']); 
    	$genre = Genre::find($id);
    	$genre -> genre = $request -> genre_name;
    	$genre -> save();

    	return redirect('/admin/tables/genres');
    }

    public function destroy($id) {
    	$genre = Genre::find($id);
    	$genre -> delete();

    	return redirect("/admin/tables/genres");
    }
}
