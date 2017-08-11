<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabMember extends Model
{
    protected $fillable = [
        'no',
        'old_no',
        'name_prefix_id',
        'firstname',
        'lastname',
        'gender',
        'birthday',
        'nationality',
        'race',
        'religion',
        'idcard',
        'home_number',
        'moo',
        'village',
        'soi',
        'road',
        'sub_district_id',
        'email',
        'phone_number',
        'type',
        'period_type',
        'blind_name',
        'blind_no',
        'blind_level',
        'blind_cause',
        'education_level',
        'education_name',
        'status',
        'career',
        'training',
        'salary',
        'guarantor_type',
        'guarantor_name',
        'remark',
        'profile_img',
        'dead',
        'dead_date',
        'dead_no',
        'age',
    ];

	protected $dates = ['birthday', 'dead_date'];

    public function name_prefix() {
    	return $this->belongsTo('App\NamePrefix');
    }

    public function sub_district() {
    	return $this->belongsTo('App\SubDistrict');
    }

    public function welfare() {
    	return $this->hasMany('App\Welfare');
    }
}
