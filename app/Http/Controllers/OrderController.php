<?php

namespace App\Http\Controllers;

use DateTime;
use App\Order;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('manager')->except([
            'index',
            'show'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = Input::get('month');

        if($month !== null){
            $p = explode('-',$month);
            $orders = Order::whereYear('created_at',$p[0])->whereMonth('created_at',$p[1])->get();
            if($orders->count() > 0){
                $date = new DateTime($orders->first()->created_at);
                $period = date_format($date,'F, Y');
            }
            else{
                $period = $p[1].', '.$p[0];
            }
        }
        else{
            $orders = Order::orderby('created_at','desc')->get();
            $period = 'All';
        }
        return view('order.index')->with('orders',$orders)->with('period',$period);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    public function rules(){
        return [
            'customer' => 'required',
            'product_type' => 'required',
            'quantity' => 'required|numeric',
            'ammount' => 'required|numeric'
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,$this->rules());
        
        $customer = Customer::findorfail($request->customer);
        $order = new Order();
        $order->customer_id = $customer->id;
        $order->user_id = Auth::id();
        $order->quantity = $request->quantity;
        $order->type = $request->product_type;
        $order->ammount = $request->ammount;
        $order->note = $request->note;
        $order->save();

        return redirect()->route('order.index')->with('success','New order created for '.$customer->fullname());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findorfail($id);
        return view('order.show')->with('order',$order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findorfail($id);
        return view('order.show')->with('order',$order);
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
        $this->validate($request,$this->rules());
        
        $order = Order::findorfail($id);
        $order->quantity = $request->quantity;
        $order->type = $request->product_type;
        $order->ammount = $request->ammount;
        $order->note = $request->note;
        $order->save();

        return redirect()->route('order.show',[$order->id])->with('success','Order #'.$order->id.' for '.$customer->fullname().' updated');
    }

    public function close($order){
        $order = Order::findorfail($order);
        $order->closed_at = now();
        $order->closed_by = Auth::id();
        $order->save();

        return redirect()->route('order.show',[$order->id])->with('success','Order closed');
    }

    public function open($order){
        $order = Order::findorfail($order);
        $order->closed_at = null;
        $order->closed_by =null;
        $order->save();

        return redirect()->route('order.show',[$order->id])->with('success','Order reopened');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findorfail($id);
        if($order->supplies->count() >0){
            foreach($order->supplies as $supply){
                $supply->delete();
            }
        }
        $order->delete();

        return redirect()->route('order.index')->with('success','Order #'.$order->id.' for '.$customer->fullname().' deleted');
    }
}
