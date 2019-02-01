<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'user_id','quantity','ammount','completed_at'];

    public function id(){
        return '#'.$this->id;
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function supplies(){
        return $this->hasMany('App\Supply');
    }
    public function totalSupplied(){
        $qty = 0;
        $amt = 0;
        $supplies = $this->supplies()->where('reverted_at',null)->get();
        foreach($supplies as $supply){
            $qty += $supply->quantity;
            $amt += $supply->ammount;
        }
        return ['quantity' => $qty, 'ammount' => $amt];
    }
    public function created_at(){
            $date = new DateTime($this->created_at);
            return date_format($date,'d M, Y H:i');

    }


    public function outstanding(){
        return [
            'quantity' => $this->quantity - $this->totalSupplied()['quantity'],
            'ammount' => $this->ammount - $this->totalSupplied()['ammount'],
        ];
    }
    public function closed(){
        return $this->closed_at === null ? false : true;
    }

    public function closed_at(){
        if($this->closed()){
            $date = new DateTime($this->closed_at);
            return date_format($date,'d M, Y H:i');
            }
            return '';

    }

    public function closed_by(){
        return User::findorfail($this->closed_by);
    }

    public function status(){
        return $this->closed() ? '<span class="text-success">closed on <strong>'.$this->closed_at().'</strong> by <strong><a href="'.route('user.show',[$this->closed_by()->id]).'">'.$this->closed_by()->fullname().'</a></strong></span>' : '<span class="text-danger">Open</span>';
    }

    public function isSuppliable(){
        return $this->outstanding()['quantity'] > 0 || $this->outstanding()['ammount'] > 0 ? true : false;
    }

}
