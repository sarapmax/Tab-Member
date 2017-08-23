<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Welfare extends Model
{
    protected $dates = ['receive_welfare_date', 'withdraw_date'];

    public function tab_member() {
    	return $this->belongsTo('App\TabMember', 'tab_member_no', 'no');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function geography() {
        return $this->belongsTo('App\Geography', 'geography_id');
    }
}
