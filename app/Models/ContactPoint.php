<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPoint extends Model {
	
	protected $fillable = ["name", "email", "telephone", "fax_number", "url"];

  public function contact()
  {
    return $this->morphTo();
  }
}
