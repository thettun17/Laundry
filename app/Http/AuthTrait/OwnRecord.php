<?php 
namespace App\Http\AuthTrait;
use Illuminate\Support\Facades\Auth;
trait OwnRecord
{
	public function isAdmin()
	{
		if( Auth::user()->is_admin == 1 ){
			return true;
		}
	}
}