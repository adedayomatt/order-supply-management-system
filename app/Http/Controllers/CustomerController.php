<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Matto\FileUpload;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except([
            'index',
            'show',
            'orders',
            'supplies'
        ]);
       }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Input::get('customer') !== null){
            return $this->show(Input::get('customer'));
        }
        return view('customer.index')->with('customers',Customer::all());
    }

    public function newPayment($id){
        return view('payment.create')->with('customer', Customer::findorfail($id));
    }
    
    public function payments($id){
        $month = Input::get('month');
        $year = Input::get('year');
        $customer = Customer::findorfail($id);
        $payments = $customer->getPayments($month, $year);
        return view('payment.index')->with('customer', $customer)
                                    ->with('payments',$payments->payments)
                                    ->with('period',$payments->period);

    }


    public function newSupply($id){
        return view('supply.create')->with('customer', Customer::findorfail($id));
    }

    public function supplies($id){
        $month = Input::get('month');
        $year = Input::get('year');
        $customer = Customer::findorfail($id);

        $supplies = $customer->getSupplies($month, $year);
        return view('supply.index')->with('customer', $customer)
                                    ->with('supplies',$supplies->supplies)
                                    ->with('period',$supplies->period);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            // 'lastname' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:customers',
            // 'phone' => 'required',
        ]);
      
        $customer = new Customer();
        $customer->firstname = $request->firstname;
        $customer->lastname =  $request->lastname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();


        return redirect()->route('customer.index')->with('success', "New customer $request->firstname $request->lastname added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $month = Input::get('month');
        $year = Input::get('year');
        
        $customer = Customer::findorfail($id);
        
        return view('customer.show')->with('customer',$customer)
                                    ->with('wallet',$customer->getWallet($month, $year))
                                    ->with('supplies', $customer->getSupplies($month, $year)->supplies)
                                    ->with('payments', $customer->getPayments($month, $year)->payments);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findorfail($id);
        return view('customer.edit')->with('customer',$customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findorfail($id);

        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            // 'lastname' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255',
            'phone' => 'required'
        ]);
      
        $customer->firstname = $request->firstname;
        $customer->lastname =  $request->lastname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect()->route('customer.show',['id'=>$customer->id])->with('success', "$request->firstname $request->lastname updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = customer::findorfail($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('success', $customer->fullname()." deleted");
    }
}
