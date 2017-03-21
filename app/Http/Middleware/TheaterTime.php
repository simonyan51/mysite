<?php

namespace App\Http\Middleware;

use Closure;
use App\Movie;

class TheaterTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $movie = Movie::with("theaters") -> where("id", $request -> id) -> first();
        if ($movie -> in_theaters !== 1) {
            return redirect("/client/movies/". $request -> id);
        }
        return $next($request);
    }
}
