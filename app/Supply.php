<?php

namespace App;

use DateTime;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = ['user_id','order_id', 'quantity','ammount','note','supplied_at','bank','transaction_id'];
    
    public function id(){
        return '#'.$this->id;
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function order(){
        return $this->belongsTo('App\Order');
    }
    public function supplied_at(){
            $date = new DateTime($this->supplied_at);
            return date_format($date,'d M, Y H:i');

    }
    public function created_at(){
        $date = new DateTime($this->created_at);
        return date_format($date,'d M, Y H:i');

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
