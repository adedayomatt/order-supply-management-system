<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Matto\FileUpload;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('manager')->except([
            'index',
            'show',
            'changePassword',
            'updatePassword'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','>', 1)->orderby('created_at','desc')->get();
        return view('user.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'position' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
      
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname =  $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->position = $request->position;
        $user->password =  Hash::make($request->password);
          
        if($request->hasFile('avatar')){
            $upload = new FileUpload(
                        $request,
                        $name = 'avatar',$title =$request->firstname.' '.$request->lastname,
                        $path = 'public/images/user'
                    );
            $user->avatar = isset($upload->slugs[0]) ? $upload->slugs[0] : null;
        }
        $user->save();

        

        return redirect()->route('user.index')->with('success', "New user $request->firstname $request->lastname added");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorfail($id);

        return view('user.show')->with('user',$user);
    }
    public function orders($user){
        $user = User::findorfail($user);
        return view('order.index')->with('orders',$user->orders)->with('period','Recorded by user - <strong><a href="'.route('user.show',[$user->id]).'">'.$user->fullname().'</a></strong>');
    }

    public function supplies($user){
        $user = User::findorfail($user);
        return view('supply.index')->with('supplies',$user->supplies)->with('period','Recorded by user - <strong><a href="'.route('user.show',[$user->id]).'">'.$user->fullname().'</a></strong>');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        return view('user.edit')->with('user',$user);
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
        $user = User::findorfail($id);

        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'position' => 'required'
        ]);
      
        $user->firstname = $request->firstname;
        $user->lastname =  $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->position = $request->position;
          
        if($request->hasFile('avatar')){
            $upload = new FileUpload(
                        $request,
                        $name = 'avatar',$title =$request->firstname.' '.$request->lastname,
                        $path = 'public/images/user'
                    );
            $user->avatar = isset($upload->slugs[0]) ? $upload->slugs[0] : null;
        }
        $user->save();
        return redirect()->route('user.show',['id'=>$user->id])->with('success', "$request->firstname $request->lastname updated");
    }

    public function changePassword($user){
        $user = User::findorfail($user);
        if(Auth::id() !== $user->id){
            return redirect()->back()->with('info','You are not authorized');
        }
        return view('user.password')->with('user',$user);
    }
    public function updatePassword(Request $request,$user){
        $user = User::findorfail($user);
        if(Auth::id() !== $user->id){
            return redirect()->back()->with('info','You are not authorized');
        }
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('user.show',[$user->id])->with('success','Password changed');
        }
        else{
            return redirect()->back()->with('error','Old password not correct');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', "$user->fullname() deleted");
    }
}
