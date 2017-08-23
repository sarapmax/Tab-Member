<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceFee extends Model
{
    protected $dates = ['start_date', 'end_date'];

    public function geography() {
        return $this->belongsTo('App\Geography', 'geography_id');
    }
}
