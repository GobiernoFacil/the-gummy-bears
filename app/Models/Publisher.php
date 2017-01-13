<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
  protected $fillable = ['scheme', 'name', 'uri', 'uid'];

  public function contracts(){
    return $this->hasMany('App\Models\Contract');
  }

  public function office(){
    return $this->hasOne('App\Models\Office', "_id", "uid");
  }

  public function buyer(){
    return $this->hasOne('App\Models\Buyer');
  }
}
