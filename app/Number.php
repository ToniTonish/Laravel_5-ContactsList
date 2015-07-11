<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    //

    public function users()
    {
    	return $this -> belongsTo('App/User');
    }
}
