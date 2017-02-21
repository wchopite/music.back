<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {

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
