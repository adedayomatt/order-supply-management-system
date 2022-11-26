<?php

namespace App;

use DateTime;
use App\User;
use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $dates = ['supplied_at'];
    protected $fillable = ['user_id','customer_id', 'quantity','type','value','note','supplied_at','bank'];
    
    public function id(){
        return '#'.$this->id;
    }
    public function user(){
        return User::withTrashed()->where('id',$this->user_id)->first();
    }

    public function customer(){
        return Customer::withTrashed()->where('id',$this->customer_id)->first();
    }

    public function supplied_at(){
            return $this->supplied_at->format('d, M, Y');

    }
    public function created_at(){
        return $this->created_at->toDayDateTimeString();
}

    public function reverted(){
        return $this->reverted_at === null ? false : true;
    }
    public function reverted_by(){
        return User::findorfail($this->reverted_by);
    }
    
    public function reverted_at(){
        if($this->reverted()){
            $date = new DateTime($this->reverted_at);
            return date_format($date,'d M, Y H:i');
            }
            return '';
    }


}
