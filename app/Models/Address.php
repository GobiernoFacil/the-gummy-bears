<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {
	protected $fillable = ["street_address", "locality", "region", "postal_code", "country_name"];

  public function address()
  {
    return $this->morphTo();
  }
}
