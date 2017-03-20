<?php

namespace App\Http\Middleware;

use Closure;
use App\Movie;
use Auth;

class Rated
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
        $ratedUser = Movie::with("ratings") -> where("id", $request -> id) -> first();
        foreach($ratedUser -> ratings as $rating) {
            if ($rating -> movie_id == $request -> id && $rating -> user_id == Auth::user() -> id) {
            return redirect("/client/movies/".$request -> id);
            }
        }
        return $next($request);
    }
}
