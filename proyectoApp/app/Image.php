<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Image extends Model
{
protected $table = 'images';

//relacion one to many

public function comments(){
    return $this->hasMAny('App\Comment');
}

public function likes(){
    return $this->hasMAny('App\Like');
}
public function user(){
    return $this->belongsTo('App\User','user_id');
}
}