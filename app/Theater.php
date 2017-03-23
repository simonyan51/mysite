<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function chairs() {
    	return $this -> hasMany("App\Chair");
    }
}
