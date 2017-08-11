<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function geography() {
		return $this->belongsTo('App\Geography');
	}
}
