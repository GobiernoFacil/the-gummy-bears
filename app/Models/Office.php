<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model {

	protected $fillable = ["_id", "name"];

	public function address(){
    return $this->morphOne('App\Models\Address', 'address');
  }

  public function contact(){
    return $this->morphOne('App\Models\ContactPoint', 'contact');
  }
}
