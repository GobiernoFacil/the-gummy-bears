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

  public function providers(){
    return $this->belongsToMany('App\Models\Provider', 'provider_tender');
  }

  public function contracts(){
    return $this->hasMany('App\Models\SingleContract');
  }

  public function release(){
    return $this->belongsTo('App\Models\Release');
  }

  public function documents(){
    return $this->morphMany('App\Models\Document', 'docs');
  }
}
