<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['firstname','lastname','email','phone'];
    
    public function orders(){
        return $this->hasMany('App\Order');
    }
    
    public function supplies(){
        
        $supplies = array();
        foreach($this->orders as $order){
            foreach($order->supplies as $supply){
                array_push($supplies, $supply);
            }
        }
       return collect($supplies)->sortByDesc('created_at');
    }

    public function fullname(){
        return $this->firstname.' '.$this->lastname;
    }
    public function lastSupply(){
        return $this->supplies()->sortByDesc('created_at')->first();
    }
    public function totalOrders(){
        $qty = 0;
        $amt = 0;
        foreach($this->orders as $order){
            $qty += $order->quantity;
            $amt += $order->ammount;  
        }
        return ['quantity' => $qty, 'ammount' => $amt];
    }
    public function totalSupplies(){
        $qty = 0;
        $amt = 0;
        $supplies = array();
        foreach($this->orders as $order){
            foreach($order->supplies->where('reverted_at',null) as $supply){
                $qty += $supply->quantity;
                $amt += $supply->ammount; 
            }
        }
       
        return ['quantity' => $qty, 'ammount' => $amt];
    }

    public function outstanding(){
        return [
            'quantity' => $this->totalOrders()['quantity'] - $this->totalSupplies()['quantity'],
            'ammount' => $this->totalOrders()['ammount'] - $this->totalSupplies()['ammount'],
        ];
    }

    public function hasOutstandingOrders(){
        $this->outstanding()['quantity'] > 0 ? true : false;
    }

}
