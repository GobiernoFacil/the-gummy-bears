<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
  protected $fillable = ["name", "rfc"];

  public function tenders(){
    return $this->belongsToMany('App\Models\Tender');
  }

  public function awards(){
    return $this->belongsToMany('App\Models\Award');
  }
    //
}
