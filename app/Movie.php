<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function genres() {
    	return $this -> belongsToMany("App\Genre");
    }

    public function ratings() {
    	return $this -> hasMany("App\Rating");
    }

    public function users() {
    	return $this -> belongsToMany("App\User");
    }

    public function comments() {
    	return $this -> hasMany("App\Comment");
    }
}
