<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMeta extends Model {

	/**
	 * Variables allowed to be mass assigned.
	 * @var [array]
	 */
	protected $fillable = [
		'name',
		'frequency',
		'recur_type',
		'recur_day_num',
		'recur_day',
		'recur_start',
		'recur_end',
	];

/**
 * Event Association.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
	public function events() {
		return $this->belongsToMany('App\Event')->withTimestamps();
	}
}
