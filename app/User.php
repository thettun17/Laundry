<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\AuthTrait\OwnRecord;
class User extends Authenticatable
{
    use Notifiable,OwnRecord;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function nickname()
    {
        $name =$this->name;
        $first = strtoupper($name[0]);
        $last = strtoupper($name[strlen($name)-1]);
        return $first."".$last;
    }
}
