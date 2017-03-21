<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    public function theaters() {
    	return $this -> belongsToMany("App\Theater");
    }

    public function users() {
    	return $this -> belongsToMany("App\User");
    }

    public function movies() {
    	return $this -> belongsToMany("App\Movie");
    }
}
