<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    public function theaters() {
    	return $this -> belongsTo("App\Theater");
    }

    public function users() {
    	return $this -> belongsTo("App\User");
    }

    public function movies() {
    	return $this -> belongsTo("App\Movie");
    }
}
