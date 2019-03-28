<?php

namespace App\Http\Controllers;

use DateTime;
use App\Supply;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SupplyController extends Controller
{
    public function __construct(){
        $this->middleware('admin')->except([
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
        $year = Input::get('year');

        if($month != null && $year != null){
            if($month == 'all' && $year == 'all'){
                $supplies = Supply::orderBy('supplied_at','desc')->get();
                $period = 'All supplies';
            }
            else{
                $supplies = Supply::whereYear('supplied_at',$year)
                            ->whereMonth('supplied_at',$month)
                            ->orderBy('supplied_at','desc')
                            ->get();

                $period = $supplies->first() != null ? $supplies->first()->supplied_at->format('M, Y') : $month.', '.$year;
                }
        
        }
        else{
            $supplies = Supply::whereYear('supplied_at',date('Y',time()))
                            ->whereMonth('supplied_at',date('m',time()))
                            ->orderBy('supplied_at','desc')
                            ->get();
            $period = 'This month: '.date('F, Y',time());
        }

        return view('supply.index')->with('supplies',$supplies)
                                    ->with('period',$period);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supply.create');
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
            'customer' => ['required'],
            'product_type' => ['required'],
            'quantity' => ['required','min: 1'],
            'quantity_value' => ['required'],
            'date_supplied' => ['required','date'],
        ]);

        $customer = Customer::findorfail($request->customer);
        Supply::create([
            'customer_id' => $request->customer,
            'user_id' => Auth::id(),
            'type' => $request->product_type,
            'quantity' => $request->quantity,
            'value' => $request->quantity_value,
            'note' => $request->note,
            'supplied_at' => $request->date_supplied
        ]);

        return redirect()->route('customer.show',[$customer->id])->with('success',$request->quantity.' supplied  to <strong>'.$customer->fullname().'</strong>');
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
    // public function edit($id)
    // {
    //     return view('supply.edit')->with('supply',Supply::findorfail($id));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'customer' => 'required',
    //         'quantity' => 'required',
    //         'ammount' => 'required',
    //     ]);
    //     $supply = Supply::findorfail($id);
    //     $supply->quantity = $request->quantity;
    //     $supply->ammount = $request->ammount;

    //     return redirect()->route('supply.show',[$supply->id])->with('success','<strong>'.$supply->demand->customer->fullname().'</strong>\'s supply updated');
    // }
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
    public function delete($id){
        $supply = Supply::findorfail($id);
        $supply->delete();

        return redirect()->back()->with('success',$supply->quantity.' supplied to '.$supply->customer()->fullname().' deleted');
    }
}
