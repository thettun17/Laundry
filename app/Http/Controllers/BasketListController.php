<?php

namespace App\Http\Controllers;
use App\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\SessionTrait\HasSession;
use Illuminate\Http\Request;
use App\Http\Requests\BasketListRequest;

class BasketListController extends Controller
{
    use HasSession;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $point = Auth::user()->point_amount;
        $totalprice = 0;
        if(session()->has('addsession')) {
            $items = session()->get('addsession');
            foreach ($items as $key => $item) {
                $totalprice += $item['totalprice'];
            }
            $remaining = $point - $totalprice ;
            session()->forget('addsession');
            return view('items.basketLists',compact('items','totalprice','point','remaining'));
        } elseif(session()->has('basketsession')) {
            $items = session()->get('basketsession');
            foreach ($items as $key => $item) {
                $totalprice += $item['totalprice'];
            }
            $remaining = $point - $totalprice ;
            session()->forget('basketsession');
            return view('items.basketLists',compact('items','totalprice','point','remaining'));
        } else {
            session()->flash('noitem');
            return redirect('items');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $item = Item::find($id);
        if(session()->has('addsession')) {
            $sessionitems = session()->get('addsession');
            return $this->itemadd($sessionitems , $id , $item ,'addsession');
        } elseif(session()->has('basketsession')) {
            $sessionitems = session()->get('basketsession');
            return $this->itemadd($sessionitems , $id , $item ,'basketsession');
        } else {
            $itemarray = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'totalprice' => $item->price,
                'quantity' => 1
            ];
            session()->push('addsession',$itemarray);
            return redirect('items')->with('addsuccess','You add '.$item->name.' Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(BasketListRequest $request, $id)
    {
        $item = Item::find($id);
        $price = $item->price;
        $quantity = $request->quantity;
        $items = session()->get('basketsession');
        foreach ($items as $key => $item) {
            if($id == $item['id']){
                $array[] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'totalprice' => $quantity * $price,
                    'quantity' => $quantity
                ];
                array_forget($items , $key);
            }
        }
        session()->forget('basketsession');
        $itemarray = array_merge($items , $array);
        session()->put('addsession' , $itemarray);
        return redirect('basketLists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = session()->get('basketsession');
        foreach ($items as $key => $item) {
            if($id == $item['id']) {
                array_forget($items , $key);
            }
        }
        session()->forget('basketsession');
        if(count($items) != 0) {
            session()->put('addsession' , $items);
            return redirect('basketLists');
        } else {
            session()->flash('noitem');
            return redirect('items');
        }
    }

    public function itemadd($sessionitems , $id , $item ,$sname)
    {  
        foreach ($sessionitems as $key => $sessionvalue) {
            if($id == $sessionvalue['id']) {
                $array[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'totalprice' => $item->price + $sessionvalue['totalprice'],
                    'quantity' => $sessionvalue['quantity'] + 1
                ];
                array_forget($sessionitems , $key);
                $newarray = array_merge($sessionitems, $array);
                session()->forget($sname);
                session()->put($sname , $newarray);
                return redirect('items')->with('addsuccess','You add '.$item->name.' Successfully!');
            }
        }
        foreach ($sessionitems as $key => $sessionvalue) {
            if($id != $sessionvalue['id']) {
                $itemarray[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'totalprice' => $item->price,
                    'quantity' => 1
                ];
                $secondarray = array_merge($sessionitems , $itemarray);
                session()->forget($sname);
                session()->put($sname,$secondarray);
                return redirect('items')->with('addsuccess','You add '.$item->name.' Successfully!');
            }
        }
    }
}
