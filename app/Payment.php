<?php

namespace App;
use App\User;
use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $dates = ['paid_on'];
    protected $fillable = ['user_id','customer_id','ammount', 'paid_on','bank','note'];
    
    public function user(){
        return User::withTrashed()->where('id',$this->user_id)->first();
    }
    
    public function created_at(){
        return $this->created_at->toDayDateTimeString();
}


    public function customer(){
        return Customer::withTrashed()->where('id',$this->customer_id)->first();
    }

    public function paid_on(){
        return $this->paid_on->format('d M, Y');
}

}
