<?php

namespace App\Http\Controllers;

use App\Item;
use App\Point;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderRequest;
use Illuminate\Routing\Redirector;
class OrderController extends Controller
{
  public function __construct()
  {
   $this->middleware('pointmiddleware', ['except' => ['create' , 'store']]);
    $this->middleware('auth');
  }
  public function create() 
  {
    $point_amount = Auth::user()->point_amount;
    $totalprice = session()->get('totalprices');
    if($point_amount < $totalprice){
      session()->flash('pointlow');
      return redirect('basketLists');
    }else{ 
      return view('orders.create');
    }
  }


  public function store(OrderRequest $request) 
  {
    $remaining = session()->get('remaining');
    $userid = Auth::user()->id;
    $user = User::find($userid);
    $user->point_amount = $remaining;
    $user->save();
    $totalamount = session()->get('totalprices');
    $order = Order::create ([
     'user_id'=> $userid,
     'address' => $request->address,
     'phone_number' =>$request->phone,
     'amount' => $totalamount,
     'pickup_date' => $request->pickupdate,
     'delivery_date' => $request->deliverydate
   ]);
    $orderid = $order->id;
    $order = Order::find($orderid);
    $items = session()->get('basketsession');
    foreach ($items as $key => $item) {
     $order->items()->attach($item['id'], [
      'quantity' => $item['quantity'],
      'unit_price' => $item['price'],
      'total_price' => $item['totalprice']
    ]);
   }

   session()->forget('basketsession');
   session()->forget('totalprices');
   session()->forget('remaining');
   session()->forget('totalprices');
   session()->flash('ordersuccess');
   return redirect('items');

 }


 public function edit(Order $order)
 {
            //
 }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function orderdetails()
    {
      $orders = Order::paginate(10);
      return view('orders.orderhistory',compact('orders'));
    }
    public function filterorder(Request $request)
    {
      $filtertype = $request->orderfilter;
      if ($filtertype == 'washing') {
        return redirect()->action('OrderController@washing');
      } elseif ($filtertype == 'delievered') {
        return redirect()->action('OrderController@delivered');
      } elseif('nodeliever' == $filtertype) {
        return redirect()->action('OrderController@notdelivered');
      } elseif('allhistory' == $filtertype) {
        return redirect()->action('OrderController@orderdetails');
      }
    }
    public function washing()
    {
      $orders = Order::where('wash' , 0)->paginate(10);
      return view('orders.orderhistory',compact('orders'));
    }
    public function notdelivered()
    {
      $orders = Order::where('deliver', '=', 0)
      ->where(function ($query) {
        $query->where('wash', '=', 1);
      })
      ->paginate(10);
      return view('orders.orderhistory',compact('orders'));
    }
    public function delivered()
    {
      $orders = Order::where('deliver', '=', 1)
      ->where(function ($query) {
        $query->where('wash', '=', 1);
      })
      ->paginate(10);
      return view('orders.orderhistory',compact('orders'));
    }
  } 
