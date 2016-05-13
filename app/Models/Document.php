<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {

  protected $fillable = ["local_id"];
	//
  public function docs()
  {
    return $this->morphTo();
  }
}
