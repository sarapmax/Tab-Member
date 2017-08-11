<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
	public function district() {
		return $this->belongsTo('App\District');
	}

    public function zipcode() {
    	return $this->hasOne('App\Zipcode');
    }
}
