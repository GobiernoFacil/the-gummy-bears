<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
  protected $fillable = ['scheme', 'name', 'uri', 'uid'];

  public function contracts(){
    return $this->hasMany('App\Models\Contract');
  }
}
