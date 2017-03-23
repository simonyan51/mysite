<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Year;
use App\Genre;
use App\Rating;
use App\User;
use App\Comment;
use Auth;
use DateTime;
use App\Chair;
use App\Theater;
use Carbon\Carbon;
use Laravel\Scout\Builder;

class TheaterController extends Controller
{
    public function __construct() {
    	$this -> dt = new DateTime();
        $this -> time = $this -> dt -> format('Y-m-d H:i:s');
        $this -> movies = Movie::with("genres", "comments", "chairs") 
        -> where('publish', 1)
        -> where('publish_time', "<=",  $this -> time)
        -> where('in_theaters', "=", 1)
        -> orderBy('created_at', 'desc');
        $this -> genres = Genre::orderBy("id", "desc") -> get();
        $this -> theaters = Theater::with("chairs") -> get();
        $this -> users = User::with("chairs") -> get();
    }

    public function index() {
        $movies = $this -> movies -> paginate(5);
    	return view("/admin.tables.theater.in_theater_movies", ['movies' => $movies]);
    }

    public function show($id) {
        $movie = $this -> movies -> where("id", $id) -> first();
        $chairs = Chair::where("movie_id", $id) -> paginate(10); 
        return view("/admin/tables/theater/order", ["movie" => $movie, "users" => $this -> users, "theaters" => $this -> theaters, "chairs" => $chairs]);
    }
}
