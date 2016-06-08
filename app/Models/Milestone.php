<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model {
  $fillable = ["implementation_id", "local_id"];
	//

  public function implementation(){
    return $this->belongsTo('App\Models\Implementation');
  }
}
