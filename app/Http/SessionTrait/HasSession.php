<?php
namespace App\Http\SessionTrait;
trait HasSession
{
	public function hassession($sessionitems , $id)
	{
		foreach ($sessionitems as $key => $sessionvalue) {
			if($sessionvalue['id'] == $id){
				return true;
			} else {
				return false;
			}
		}
	}
}