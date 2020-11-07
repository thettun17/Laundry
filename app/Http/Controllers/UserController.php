<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequests;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangenameRequests;
use App\Http\Requests\AdduserRequest;
//use Illuminate\Routing\Redirector;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('pointmiddleware',['only'=>[
            'orderuser',
            'orderdetail',
            'washlist',
            'washfinish',
            'deliverlist',
            'deliverfinish',
            'create',
            'store'
        ]
    ]);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::all();
       return view('user.index',compact('users'));
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
    public function store(AdduserRequest $request)
    {
        $password = Hash::make($request->password);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'is_admin' => $request->role
        ]);
        return redirect('items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
     //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function namechange()
    {
        return view('user.changename');
    }
    public function passwordchange()
    {
        return view('user.changepassword');
    }

    public function changename(ChangenameRequests $request)
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $user->name = $request->changename;
        $user->save();
        session()->flash('changedname' , $request->changename);
        return redirect('namechange');
    }

    public function changepassword(ChangePasswordRequests $request)
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $userpassword = $user->password;
        $haspassword = Hash::make($request->password);
        if (Hash::check($request->currentpassword, $userpassword)) {
            $user->password = $haspassword;
            $user->save();
            session()->flash('changedpassword');
            return redirect('passwordchange');
        }else{
            session()->flash('unchangedpassword');
            return redirect('passwordchange');
        }
    }

    public function orderuser()
    {
        $orders = Order::where('deliver',0)->paginate(10);
        return view('user.ordereduser',compact('orders'));

    }
    public function orderdetail($id)
    {
        $order = Order::FindOrFail($id);
        return view('user.orderdetail',compact('order'));
    }
    public function washlist()
    {
        $orders = Order::where('wash',0)->orderBy('delivery_date')->paginate(10);
        return view('user.washlist',compact('orders'));
    }
    public function washfinish($id)
    {
        $order = Order::FindOrFail($id);
        $order->wash = 1;
        $order->save();
        session()->flash('washlist' , $order->user->name);
        return redirect('washlist');
    }
    public function deliverlist()
    {
        $orders = Order::where('deliver', '=', 0)
        ->where(function ($query) {
            $query->where('wash', '=', 1);
        })
        ->paginate(10);
        return view('user.deliverlist',compact('orders'));
    }
    public function deliverfinish($id)
    {   
        $order = Order::FindOrFail($id);
        $order->deliver = 1;
        $order->save();
        session()->flash('deliverlist' , $order->user->name);
        return redirect('deliverlist');
    }
    public function orderhistory()
    {
        $userid = Auth::user()->id;
        $orders = Order::where('user_id','=',$userid)->paginate(10);
        return view('user.orderhistory',compact('orders'));
    }

    public function userorderdetail($id)
    {
        $order = Order::FindOrFail($id);
        return view('user.userorderdetail',compact('order'));
    }
    public function personorderhistory(Request $request)
    {

        $filter = $request->userorderhistory;
        if ($filter == 'all') {
            return redirect()->action('UserController@orderhistory');
        } elseif ($filter == 1) {
            return redirect()->action('UserController@recieved');
        } elseif ($filter == 0) {
            return redirect()->action('UserController@notrecieved');
        }
    }
    public function recieved()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id' , $id)->where(function ($query) {
            $query->where('deliver', '=', 1);
        })->paginate(10);
        return view('user.orderhistory',compact('orders'));
    }
    public function notrecieved()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id' , $id)->where(function ($query) {
            $query->where('deliver', '=', 0);
        })->paginate(10);
        return view('user.orderhistory',compact('orders'));
    }

}
