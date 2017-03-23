<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Genre;
use App\Rating;
use App\User;
use App\Comment;
use Auth;
use DateTime;
use App\Chair;
use App\Theater;
use Laravel\Scout\Builder;



class TheaterController extends Controller
{
	public function __construct()
    {
        $this -> dt = new DateTime();
        $this -> time = $this -> dt -> format('Y-m-d H:i:s');
        $this -> movies = Movie::with("genres", "comments", "chairs") 
        -> where('publish', 1)
        -> where('publish_time', "<=",  $this -> time)
        -> orderBy('created_at', 'desc') ->get();
        $this -> genres = Genre::orderBy("id", "desc") -> get();

        $this -> soonMovies = Movie::with('genres') 
        -> where('publish', 1)
        -> where('publish_time', ">",  $this -> time)
        -> orderBy('created_at', 'desc') -> get();
        $this -> theaters = Theater::with("chairs") -> get();
        $this -> users = User::with("chairs") -> get();
        $this -> chairs = Chair::all();
    }

    public function index($id) {
    	$movie = $this -> movies -> where("id", $id) -> first();
    	return view("client.contents.theaters.theaters", ["movie" => $movie, "genres" => $this -> genres]);
    }

    public function redTheater($id, Request $request) {
        $chairs = new Chair();
        $theater = $this -> theaters -> where("id", 3) -> first();
        $movie = $this -> movies -> where("id", $id) -> first();
        $user = $this -> users -> where("id", Auth::user() -> id) -> first();
        if ($request -> chair_id) {
            $chairs -> user_id = $user -> id;
            $chairs -> theater_id = 3;
            $chairs -> movie_id = $id;
            $chairs -> chair = $request -> chair_id;
            $chairs -> save();
        }
        return view("client.contents.theaters.red_theater", ["movie" => $movie, "genres" => $this -> genres, "chairs" => $this -> chairs]);
    }
    
    public function blueTheater($id, Request $request) {
    	$chairs = new Chair();
        $theater = $this -> theaters -> where("id", 2) -> first();
        $movie = $this -> movies -> where("id", $id) -> first();
        $user = $this -> users -> where("id", Auth::user() -> id) -> first();
        if ($request -> chair_id) {
            $chairs -> user_id = $user -> id;
            $chairs -> theater_id = 2;
            $chairs -> movie_id = $id;
            $chairs -> chair = $request -> chair_id;
            $chairs -> save();
        }
        return view("client.contents.theaters.blue_theater", ["movie" => $movie, "genres" => $this -> genres, "chairs" => $this -> chairs]);
    }
    
    public function greenTheater($id, Request $request) {
    	$chairs = new Chair();
        $theater = $this -> theaters -> where("id", 1) -> first();
        $movie = $this -> movies -> where("id", $id) -> first();
        $user = $this -> users -> where("id", Auth::user() -> id) -> first();
        if ($request -> chair_id) {
            $chairs -> user_id = $user -> id;
            $chairs -> theater_id = 1;
            $chairs -> movie_id = $id;
            $chairs -> chair = $request -> chair_id;
            $chairs -> save();
        }
        return view("client.contents.theaters.green_theater", ["movie" => $movie, "genres" => $this -> genres, "chairs" => $this -> chairs]);
    }
}
