<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class User extends Model 
{
 

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['password', 'remember_token'];

    public function numbers() 
    {
        return $this -> hasMany('App/Number');
    }

    public function emails()
    {
        return $this -> hasMany('App/Email');
    }
}
