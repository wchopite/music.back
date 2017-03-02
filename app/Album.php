<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model {

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
	 protected $fillable = [
		 'artist_id',
		 'gender_id',
		 'name',
		 'year',
		 'description',
		 'path'
	 ];

	 /**
	  * [$hidden description]
	  * @var [type]
	  */
	 protected $hidden = ['deleted_at','created_at'];

	 /**
	  * [gender description]
	  * @return [type] [description]
	  */
	 public function gender() {

		 return $this->belongsTo('App\Gender');
	 }

	 /**
	  * [artist description]
	  * @return [type] [description]
	  */
	 public function artist() {

		 return $this->belongsTo('App\Artist');
	 }
}
