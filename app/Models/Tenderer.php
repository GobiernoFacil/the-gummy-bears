<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenderer extends Model
{
  protected $fillable = ["rfc"];

  public function tenders(){
    return $this->belongsToMany('App\Models\Tender');
  }

  public function address(){
    return $this->morphOne('App\Models\Address', 'address');
  }

  public function contact(){
    return $this->morphOne('App\Models\ContactPoint', 'contact');
  }
}
