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
use Laravel\Scout\Builder;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this -> dt = new DateTime();
        $this -> time = $this -> dt -> format('Y-m-d H:i:s');
        $this -> movies = Movie::with('genres') -> with('comments') 
        -> where('publish', 1)
        -> where('publish_time', "<=",  $this -> time)
        -> orderBy('updated_at', 'desc') ->get();
        $this -> genres = Genre::orderBy("id", "desc") -> get();

        $this -> soonMovies = Movie::with('genres') 
        -> where('publish', 1)
        -> where('publish_time', ">",  $this -> time)
        -> orderBy('updated_at', 'desc') ->get();

        $this -> inTheatersTime($this -> movies);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.contents.movies', ['movies' => $this -> movies, "currentDate" => $this -> time, "genres" => $this -> genres]);
    }

    public function show($id) {
        $movie = $this -> movies -> where("id", $id) -> first();
        if(Auth::user()) {
            $ratedUser = $this -> isRated($id);
            return view('client.contents.movie_show', 
                [
                'movie' => $movie, 
                "ratedUser" => $ratedUser,
                "genres" => $this -> genres,
                ]);
        }
        return view('client.contents.movie_show', ['movie' => $movie, "genres" => $this -> genres]);
    }

    public function rate($id, Request $request)
     {
        $movie = Movie::with("ratings") -> where("id", $id) -> first();
        $ratings = new Rating();
        $ratings -> user_id = Auth::user() -> id;
        $ratings -> rating = $request -> rating;
        $movie -> ratings() -> save($ratings);
        $this -> countRating($id);
        return redirect("/client/movies/$id");
    }

    public function comment($id, Request $request) {
        $comment = new Comment();
        $comment -> user_id = $request -> input("user_id");
        $comment -> user_name = $request -> input("user_name");
        $comment -> movie_id = $request -> input("movie_id");
        $comment -> comment = $request -> input("comment");
        $comment -> save();
        return $this -> show($id);
    }

    public function publishDate($publishTime) {
        $selectedMovies = Movie::with('genres') 
        -> where('publish', 1)
        -> where('publish_time', ">=",  $publishTime." 00:00:00")
        -> where('publish_time', "<=",  $publishTime." 23:59:59")
        -> orderBy('updated_at', 'desc') ->get();
        return view('client.contents.movies', ['movies' => $selectedMovies, "currentDate" => $this -> time, "genres" => $this -> genres]);
    }

    public function comingSoon() {
        return view('client.contents.movies', ['movies' => $this -> soonMovies, "currentDate" => $this -> time, "genres" => $this -> genres]);

    }

    public function search(Request $request) {
        $selectedMovies = [];
        foreach ($this -> movies as $movie) {
            if (strpos(strtolower($movie -> movie_name), strtolower($request -> search)) !== false) {
                array_push($selectedMovies, $movie);
            }
        }
        return view('client.contents.movies', ['movies' => $selectedMovies, "currentDate" => $this -> time, "genres" => $this -> genres]);
    }

    public function searchByGenre($id) {
        $genre = Genre::find($id);
        $movies = $this -> movies;
        $selectedMovies = [];
        foreach($movies as $movie) {
            foreach($movie -> genres as $movieGenre) {
                if ($genre -> genre == $movieGenre -> genre) {
                    array_push($selectedMovies, $movie);
                }
            }
        }
        return view("/client.contents.movies", ["movies" => $selectedMovies, "currentDate" => $this -> time, "genres" => $this -> genres]);
    }

    public function inTheaters() {
        $selectedMovies = Movie::with('genres') 
        -> where('publish', 1)
        -> where('publish_time', "<=",  $this -> time)
        -> where('in_theaters', "=", 1)
        -> orderBy('updated_at', 'desc') ->get();
        return view("/client.contents.movies", ["movies" => $selectedMovies, "currentDate" => $this -> time, "genres" => $this -> genres]);
    }

    public function topRated() {
        $this -> movies = Movie::with('genres') 
        -> where('publish', 1)
        -> where('publish_time', "<=",  $this -> time)
        -> orderBy('rating', 'desc') ->get();

        return view('client.contents.movies', ['movies' => $this -> movies, "currentDate" => $this -> time, "genres" => $this -> genres]);

    }

    private function countRating($id, $sumOfRating = 0) {
        $movie = Movie::with("ratings") -> where("id", $id) -> first();

        foreach($movie -> ratings as $rating) {
            $sumOfRating += $rating -> rating;
        }

        $count = count($movie -> ratings);
        $result = round($sumOfRating / $count);
        $movie -> rating = $result;
        $movie -> save();
        return;
    }
    private function inTheatersTime($movies) {
        foreach ($movies as $movie) {
            if ($movie -> in_theaters_time > $this -> time) {
                $movie -> in_theaters = 1;
                $movie -> save();
            } else if ($movie -> in_theaters_time < $this -> time) {
                $movie -> in_theaters = 0;
                $movie -> save();
            }
        }
        return;
    }

    private function isRated($id) {
        $ratedUser = Movie::with("ratings") -> where("id", $id) -> first();
        foreach($ratedUser -> ratings as $rating) {
            if ($rating -> movie_id == $id && $rating -> user_id == Auth::user() -> id) {
            return true;
            }
        }
        return false;
    }
}
