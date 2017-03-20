<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Year;
use App\Comment;
use Carbon\Carbon;
use DateTime;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $movies = Movie::with('genres')->orderBy("updated_at", "desc") -> paginate(5);
        return view("/admin.tables.movies.movies", ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this -> validate($request, [
               'movie_name' => 'required', 
               'year' => 'required', 
               'image' => 'required', 
               'country' => 'required', 
               'genre' => 'required', 
               'producer' => 'required', 
               'time' => 'required', 
               'starting' => 'required', 
               'descr' => 'required',
               'publish_time' => 'required',
               'in_theaters_time' => 'required',
            ]);

        $movie_name = $request -> input('movie_name');
        $year = $request -> input('year');
        $image = $request -> image -> getClientOriginalName();
        $country = $request -> input('country');
        $genre = $request -> input('genre');
        $producer = $request -> input('producer');
        $time = $request -> input('time');
        $starting = $request -> input('starting');
        $descr = $request -> input('descr');
        $publish_time = $request -> input('publish_time');
        $in_theaters_time = $request -> input('in_theaters_time');

        $image = explode(".", $image);
        $image = time().$image[0].'.'.$image[1];
        $request -> file('image') -> move(public_path('uploads'), $image);

        DB::table("movies") -> insert([
            'movie_name' => $movie_name,
            'year' => $year,
            'image' => $image,
            'country' => $country,
            'producer' => $producer,
            'time' => $time,
            'starting' => $starting,
            'descr' => $descr,
            'publish_time' => $publish_time,
            'in_theaters_time' => $in_theaters_time,

            ]);
        foreach($genre as $genreId) {
            $movie = Movie::all() -> last();
            $movie -> genres() -> attach($genreId);
        }
        return redirect("/admin/tables/movies");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $movie = Movie::with('genres') -> where('id', $id)
       -> first();
       return view("/admin.tables.movies.movie_show", ['movie' => $movie]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
               'movie_name' => 'required', 
               'year' => 'required', 
               'image' => 'required', 
               'country' => 'required', 
               'genre' => 'required', 
               'producer' => 'required', 
               'time' => 'required', 
               'starting' => 'required', 
               'descr' => 'required',
               'publish_time' => 'required',
               'in_theaters_time' => 'required',
            ]);

        $movie_name = $request -> input('movie_name');
        $year = $request -> input('year');
        $image = $request -> image -> getClientOriginalName();
        $country = $request -> input('country');
        $genre = $request -> input('genre');
        $producer = $request -> input('producer');
        $time = $request -> input('time');
        $starting = $request -> input('starting');
        $descr = $request -> input('descr');
        $publish_time = $request -> input('publish_time');
        $in_theaters_time = $request -> input('in_theaters_time');

        $movie = DB::table('movies') -> where('id', $id);
        unlink(public_path('uploads/'.$movie -> first() -> image));
        
        $image = explode(".", $image);
        $image = time().'.'.$image[0].'.'.$image[1];
        $request -> file('image') -> move(public_path('uploads'), $image);

        DB::table('movies') -> where('id', $id)
        -> update([
            'movie_name' => $movie_name,
            'year' => $year,
            'image' => $image,
            'country' => $country,
            'producer' => $producer,
            'time' => $time,
            'starting' => $starting,
            'descr' => $descr,
            'publish_time' => $publish_time,
            'in_theaters_time' => $in_theaters_time,
        ]);
        
        $movie = Movie::find($id);
        $movie -> genres() -> sync($genre);

        return redirect('/admin/tables/movies');
    }

    public function removeComment($movieId, $commentId) {
        $comment = Comment::find($commentId) -> first();
        $comment -> delete();
        return redirect("/admin/tables/movies/". $movieId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        unlink(public_path('uploads/'.$movie -> image));
        $movie -> genres() -> detach();
        $movie -> delete();


        return redirect('/admin/tables/movies');
    }

    public function publish($id) {
        $movie = Movie::find($id);
        if ($movie -> publish) {
            $movie -> publish = 0;
            $movie -> save();
        } else if (!$movie -> publish) {
            $movie -> publish = 1;
            $movie -> save();
        }
        return redirect('/admin/tables/movies');
    }

}
