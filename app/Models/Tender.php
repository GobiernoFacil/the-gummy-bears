<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
  protected $fillable = ["release_id"];

  /*
  public function items(){
    return $this->hasMany('App\Models\Item');
  }
  */

  public function items(){
    return $this->morphMany('App\Models\Item', 'myitem');
  }

  public function tenderers(){
    return $this->belongsToMany('App\Models\Tenderer');
  }

  public function contracts(){
    return $this->hasMany('App\Models\SingleContract');
  }
}
