<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Matto\FileUpload;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{

    public function __construct(){
        $this->middleware('manager')->except([
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    public function order($id){
        $customer = Customer::findorfail($id);
        return view('order.create')->with('customer',$customer);
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
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required',
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
        $customer = Customer::findorfail($id);
        return view('customer.show')->with('customer',$customer);
    }

    public function orders($customer){
        $customer = Customer::findorfail($customer);
        return view('order.index')->with('orders',$customer->orders)->with('orders',$customer->orders)->with('period','Recorded for customer - <strong><a href="'.route('customer.show',[$customer->id]).'">'.$customer->fullname().'</a></strong>');
    }

    public function supplies($customer){
        $customer = Customer::findorfail($customer);
        return view('supply.index')->with('supplies',$customer->supplies())->with('period','Recorded for customer - <strong><a href="'.route('customer.show',[$customer->id]).'">'.$customer->fullname().'</a></strong>');
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
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
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
