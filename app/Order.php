<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [
		'user_id',
		'address',
		'phone_number',
		'amount',
		'pickup_date',
		'delivery_date',
		'wash',
		'deliver',
		'pickup'
	];

	protected $dates = [
		'pickup_date',
		'delivery_date'
	];

	public function user() {

    	return $this->belongsTo('App\User');
    }

    public function items() {	
    	return $this->belongsToMany('App\Item')->withPivot('quantity','unit_price','total_price');
    }
}
