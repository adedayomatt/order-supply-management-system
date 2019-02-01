<?php

namespace App;

use App\Supply;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname','email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function supplies(){
        return $this->hasMany('App\Supply');
    }

    public function reverts(){
        return Supply::where('reverted_by',$this->id)->get();
    }

    public function fullname(){
        return $this->firstname.' '.$this->lastname;
    }
    public function position(){
        switch($this->position){
            case 4:
                return 'Managing Director';
            break;
            case 3:
                return 'Manager';
            break;
            case 2:
                return 'Marketer';
            break;
            case 1:
                return 'Customer care';
            break;
            default:
                return 'Regular';
            break;
        }
    }
    public function avatar(){
		$image = array();
		$image['src'] = $this->avatar === null ? asset('storage/images/users/default.png') : asset('storage/images/users/'.$this->avatar);
		$image['alt'] = $this->name;
		return $image;
    }

}
