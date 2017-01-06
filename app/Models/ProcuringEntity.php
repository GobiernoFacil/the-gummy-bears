<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcuringEntity extends Model {

	protected $fillable = ['_id', 'name', 'uri'];

	public function address(){
    return $this->morphOne('App\Models\Address', 'address');
  }

  public function contact(){
    return $this->morphOne('App\Models\ContactPoint', 'contact');
  }

}
