<?php

namespace App\Http\Controllers;

use DateTime;
use App\Order;
use App\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SupplyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = Input::get('month');

        if($filter !== null){
            $p = explode('-',$filter);
            $supplies = Supply::whereYear('created_at',$p[0])->whereMonth('created_at',$p[1])->get();
            if($supplies->count() > 0){
                $date = new DateTime($supplies->first()->created_at);
                $period = date_format($date,'F, Y');
            }
            else{
                $period = $p[1].', '.$p[0];
            }
        }
        else{
            $supplies = Supply::orderby('created_at','desc')->get();
            $period = 'All';
        }
        return view('supply.index')->with('supplies',$supplies)->with('period',$period);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($order)
    {
        $order = Order::findorfail($order);
        return view('supply.create')->with('order',$order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$order)
    {
        //     $this->validate($request, [
        //     'order' => 'required',
        //     'quantity' => 'required',
        //     'ammount' => 'required',
        //     'bank' => 'required',
        // ]);

        $order = Order::findorfail($order);
        Supply::create([
            'order_id' => $request->order,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'ammount' => $request->ammount,
            'note' => $request->note,
            'bank' => $request->bank,
            'transaction_id' => $request->transaction,
            'supplied_at' => $request->date_supplied
        ]);

        return redirect()->route('order.show',[$order->id])->with('success',$request->quantity.' supplied  to order <strong>'.$order->id().'</strong> for <strong>'.$order->customer->fullname().'</strong>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('supply.show')->with('supply',Supply::findorfail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('supply.edit')->with('supply',Supply::findorfail($id));
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
        $this->validate($request, [
            'customer' => 'required',
            'quantity' => 'required',
            'ammount' => 'required',
        ]);
        $supply = Supply::findorfail($id);
        $supply->quantity = $request->quantity;
        $supply->ammount = $request->ammount;

        return redirect()->route('supply.show',[$supply->id])->with('success','<strong>'.$supply->demand->customer->fullname().'</strong>\'s supply updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revert($id)
    {
        $supply = Supply::findorfail($id);
        $order = $supply->order;

        $supply->reverted_at = now();
        $supply->reverted_by = Auth::id();
        $supply->save();
        return redirect()->route('order.show',[$order->id])->with('success','supply for order <strong> '.$supply->order->id().'</strong>\'s reverted');

    }
}
