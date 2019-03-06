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
            case 1:
                return 'Super Admin';
            break;
            case 2:
                return 'Managing Director';
            break;
            case 3:
                return 'Manager';
            break;
            case 4:
                return 'Admin';
            break;
            case 5:
                return 'Marketer';
            break;
            case 6:
                return 'Customer Care';
            break;

            default:
                return 'Regular';
            break;
        }
    }

    public function isSuperAdmin(){
        return $this->position == 1 ? true : false;
    }
    public function isMD(){
        return $this->position == 2 ? true : false;
    }
    public function isManager(){
        return $this->position == 3 ? true : false;
    }

    public function isAdmin(){
        return $this->position == 4 ? true : false;
    }
    public function isMarketer(){
        return $this->position == 5 ? true : false;
    }
    public function isCC(){
        return $this->position == 6 ? true : false;
    }

    public function avatar(){
		$image = array();
		$image['src'] = $this->avatar === null ? asset('storage/images/users/default.png') : asset('storage/images/users/'.$this->avatar);
		$image['alt'] = $this->name;
		return $image;
    }

}
