<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Welfare extends Model
{
    public function tab_member() {
    	return $this->belongsTo('App\TabMember', 'tab_member_no');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
