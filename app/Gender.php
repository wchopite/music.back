<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	 protected $fillable = ['name'];

	 /**
	  * [albums description]
	  * @return [type] [description]
	  */
	 public function albums() {

		return $this->hasMany('App\Album');
	 }
}
