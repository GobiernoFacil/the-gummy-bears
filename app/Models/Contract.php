<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
  protected $fillable = ['ocdsid', 'ejercicio', 'cvedependencia', 'nomdependencia', 'published_date', 'uri', 'publisher_id'];

  public function publisher(){
    return $this->belongsTo('App\Models\Publisher');
  }

  public function releases(){
    return $this->hasMany('App\Models\Release');
  }

  public function history(){
    return $this->hasMany('App\Models\ContractHistory');
  }

  public function data(){
    return $this->hasOne('App\Models\ContractData');
  }

  public function plannings(){
    return $this->hasManyThrough('App\Models\Planning', 'App\Models\Release');
  }

  public function tenders(){
    return $this->hasManyThrough('App\Models\Tender', 'App\Models\Release');
  }

  public function awards(){
    return $this->hasManyThrough('App\Models\Award', 'App\Models\Release');
  }
}
