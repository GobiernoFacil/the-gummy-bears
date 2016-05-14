<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SingleContract extends Model
{
  protected $fillable = ['local_id', 'release_id'];

  public function items(){
    return $this->morphMany('App\Models\Item', 'myitem');
  }

  public function release(){
    return $this->belongsTo('App\Models\Release');
  }

  public function documents(){
    return $this->morphMany('App\Models\Document', 'docs');
  }
}
