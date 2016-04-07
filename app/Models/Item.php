<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = ['local_id', 'tender_id'];

  public function myitem(){
    return $this->morphTo();
  }
}
