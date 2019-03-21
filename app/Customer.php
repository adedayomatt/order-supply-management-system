<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes; 

    protected $dates = ['deleted_at'];
    protected $fillable = ['firstname','lastname','email','phone'];
    
    public function supplies(){
        return $this->hasMany('App\Supply');
    }
    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function fullname(){
        return $this->firstname.' '.$this->lastname;
    }

    public function isDeleted(){
        return $this->deleted_at == null ? false : true;
    }


    public function lastSupply(){
        return $this->supplies->sortByDesc('created_at')->first();
    }

    public function lastPayment(){
        return $this->payments->sortByDesc('created_at')->first();
    }


    public function totalSupplies(){
        $qty = 0;
        $amt = 0;
        $supplies = array();
        foreach($this->supplies as $supply){
            $qty += $supply->quantity;
            $amt += $supply->value; 
        }
       
        return ['quantity' => $qty, 'value' => $amt];
    }

    public function totalPayment(){
        $amt = 0;
        foreach($this->payments as $payment){
            $amt += $payment->ammount;
        }
        return $amt;
    }

    public function wallet(){
        return (object) [
            'total' => $this->totalPayment(),
            'spent' => $this->totalSupplies()['value'],
            'balance' =>  $this->totalPayment() - $this->totalSupplies()['value'],
        ];
    }

    public function getPayments($month=null, $year =null){
        if($month != null && $year != null){
            if($month == 'all' && $year = 'all'){
                $payments = $this->payments()
                            ->orderBy('paid_on','desc')
                            ->get();
                $period = "All payments";
            }
            else{
                $payments = $this->payments()
                            ->whereYear('paid_on',$year)
                            ->whereMonth('paid_on',$month)
                            ->orderBy('paid_on','desc')
                            ->get();
                $period = $payments->first() != null ? $payments->first()->paid_on->format('M, Y') : $month.', '.$year;
            }
        }
        else{
            $payments = $this->payments()
                                ->whereYear('paid_on',date('Y',time()))
                                ->whereMonth('paid_on',date('m',time()))
                                ->orderBy('paid_on','desc')
                                ->get();
            $period = 'This Month: '.date('Y',time());
        }

        return (object) ['payments' => $payments,'period' => $period];
    } 

    public function getSupplies($month=null, $year=null){
        if($month != null && $year != null){
            if($month == 'all' && $year = 'all'){
                $supplies = $this->supplies()
                                ->orderBy('supplied_at','desc')
                                ->get();
                $period = 'All supplies';

            }
            else{
                $supplies = $this->supplies()
                            ->whereYear('supplied_at',$year)
                            ->whereMonth('supplied_at',$month)
                            ->orderBy('supplied_at','desc')
                            ->get();
                $period = $supplies->first() != null ? $supplies->first()->supplied_at->format('M, Y') : $month.', '.$year;
                }
        }
        else{
            $supplies = $this->supplies()
                            ->whereYear('supplied_at',date('Y',time()))
                            ->whereMonth('supplied_at',date('m',time()))
                            ->orderBy('supplied_at','desc')
                            ->get();
            $period = 'This month: '.date('Y',time());
        }
        return (object) ['supplies' => $supplies,'period' => $period];
    }


    public function getWallet($month=null,$year=null){
        if($month != null && $year != null){

            if($month == 'all' && $year == 'all'){
                $payments = $this->payments()
                            ->orderBy('paid_on','desc')
                            ->get();
                $supplies = $this->supplies()
                            ->orderBy('supplied_at','desc')
                            ->get();
                $period = "All";

            }else{

                $payments = $this->payments()
                            ->whereYear('paid_on',$year)
                            ->whereMonth('paid_on',$month)
                            ->orderBy('paid_on','desc')
                            ->get();

                $supplies = $this->supplies()
                            ->whereYear('supplied_at',$year)
                            ->whereMonth('supplied_at',$month)
                            ->orderBy('supplied_at','desc')
                            ->get();

                $period = $payments->first() != null ? $payments->first()->paid_on->format('M, Y') : $month.', '.$year;

            }
            
        }
        else{

            $payments = $this->payments()
                        ->whereYear('paid_on',date('Y',time()))
                        ->whereMonth('paid_on',date('m',time()))
                        ->orderBy('paid_on','desc')
                        ->get();

            $supplies = $this->supplies()
                        ->whereYear('supplied_at',date('Y',time()))
                        ->whereMonth('supplied_at',date('m',time()))
                        ->orderBy('supplied_at','desc')
                        ->get();

            $period = 'This month: '.date('F, Y',time());

    }
    return (object) [
                'total' => $payments->sum('ammount'),
                'spent' => $supplies->sum('value'),
                'balance' => $payments->sum('ammount') - $supplies->sum('value'),
                'period' => $period
        ];
    }



}
