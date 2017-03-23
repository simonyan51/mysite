<?php

namespace App\Http\Middleware;

use Closure;
use App\Movie;
use Auth;

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
        $movie = Movie::with("chairs") -> where("id", $request -> id) -> first();
        if ($movie -> in_theaters !== 1) {
            if (Auth::user() -> admin === 0)
                return redirect("/client/movies/");
            return redirect("/admin/tables/movies");
        }
        return $next($request);
    }
}
