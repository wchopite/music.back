<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model {

	use SoftDeletes;

	/**
	 * [$dates description]
	 * @var [type]
	 */
	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	 protected $fillable = ['name'];

	 /**
	  * [$hidden description]
	  * @var [type]
	  */
	 protected $hidden = ['deleted_at','created_at'];

	 /**
	  * Mutator Setea a mayusculas la primera letra de cada palabra
	  * del campo nombre
	  *
	  * @param [type] $value [description]
	  */
	 public function setNameAttribute($value) {

		 $this->attributes['name'] = ucfirst(strtolower($value));
	 }

	 /**
	  * Relacion 1:N con modelo Album
	  */
	 public function albums() {

		 return $this->hasMany('App\Album');
 	} 
}
