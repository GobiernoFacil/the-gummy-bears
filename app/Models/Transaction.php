<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

  protected $fillable = ["implementation_id", "local_id"];

  public function implementation(){
    return $this->belongsTo('App\Models\Implementation');
  }
	//

}
