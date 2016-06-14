<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Implementation extends Model {
  protected $fillable = ["contract_id", "release_id"];
	//

  public function documents(){
    return $this->morphMany('App\Models\Document', 'docs');
  }

  public function milestones(){
    return $this->hasMany('App\Models\Milestone');
  }

  public function transactions(){
    return $this->hasMany('App\Models\Transaction');
  }

  public function contract(){
    return $this->belongsTo('App\Models\SingleContract');
  }
}
