<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
  protected $fillable = ["release_id", "amount", "currency", "project"];
  
  public function release(){
    return $this->belongsTo('App\Models\Release');
  }

  public function documents(){
    return $this->morphMany('App\Models\Document', 'docs');
  }
    //
}
