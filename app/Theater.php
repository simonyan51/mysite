<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function chairs() {
    	return $this -> belongsToMany("App\Chair");
    }

    public function movies() {
    	return $this -> belongsToMany("App\Movie");
    }
}
