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

    public function  province() {
	    return $this->belongsTo('App\Province', 'province_id', 'id');
    }

    public function geography() {
	    return $this->belongsTo('App\Geography', 'geography_id', 'id');
    }
}
