<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('admin')->except([
            'index',
            'show'
        ]);
    }

    public function index(){
        $month = Input::get('month');
        $year = Input::get('year');

        if($month != null && $year != null){
            if($month == 'all' && $year == 'all'){
                $payments = Payment::orderBy('paid_on','desc')->get();
                $period = 'All payments';
            }
            else{
                $payments = Payment::whereYear('paid_on',$year)
                                ->whereMonth('paid_on',$month)
                                ->orderBy('paid_on','desc')
                                ->get();
                $period = $payments->first() != null ? $payments->first()->paid_on->format('M, Y') : $month.', '.$year;
            }
        }
        else{
            $payments = Payment::orderBy('paid_on','desc')->get();
            $period = 'All';
        }

        return view('payment.index')->with('payments',$payments)
                                    ->with('period',$period);


    }
    public function create(){
        return view('payment.create');
    }

    public function store(Request $request)
    {

            $this->validate($request, [
            'customer' => ['required'],
            'ammount' => ['required'],
            'bank' => ['required'],
            'date_paid' => ['required', 'date']
        ]);

        $customer = Customer::findorfail($request->customer);
        Payment::create([
            'customer_id' => $request->customer,
            'user_id' => Auth::id(),
            'ammount' => $request->ammount,
            'note' => $request->note,
            'bank' => $request->bank,
            'paid_on' => $request->date_paid
        ]);

        return redirect()->route('customer.show',[$customer->id])->with('success',$request->ammount.' added to <strong>'.$customer->fullname().'</strong> wallet');
    }

    public function delete($id){
        $payment = Payment::findorfail($id);
        $payment->delete();

        return redirect()->back()->with('success',$payment->ammount.' paid by '.$payment->customer->fullname().' deleted');
    }
}
