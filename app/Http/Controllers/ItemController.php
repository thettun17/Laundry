<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Item;
use App\Point;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\FormSearchRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('pointmiddleware',['only'=>['create','edit','delete']]);
        $this->middleware('auth',['except'=>'index']);
    }

    public function index() {
        $items = Item::get();
        return view('items.index',compact('items'));

    }

    public function create() {

        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $file = $request->file('image');
        $file_name = uniqid().'-'.$file->getClientOriginalName();
        Image::make($file->getRealPath())->resize(300, 300)->save(public_path('upload/' . $file_name));
        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $file_name
        ]);
        session()->flash('itemcreated');
        return redirect('items');
    }
    

    public function show() {
        $items = Item::all();
        return view ('items.show',compact('items'));
    }

    public function edit($id) {
        $item = Item::findOrFail($id);
        return view("items.edit",compact('item'));
    }

    public function update(ItemRequest $request, $id) {
        $file = $request->file('image');
        $item = Item::findOrFail($id);
        if($file != null) {
            $file_name = uniqid().'-'.$file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save(public_path('upload/' . $file_name));
            File::delete(public_path('upload/'.$item->image));
            $item->name = $request->name;
            $item->price = $request->price;
            $item->image = $file_name;
            $item->save();
        } else {
            $item->name = $request->name;
            $item->price = $request->price;
            $item->save();
        }
        session()->flash('itemupdated' , $item->name);
        return redirect('items');
    }

    public function destroy($id) 
    {
        $orders = Order::all();
        $item = Item::findOrFail($id);
        foreach ($orders as $key => $order) {
            foreach ($order->items as $key => $orderitem) {
                if($id == $orderitem->id) {
                    session()->flash('nodelete');
                    return redirect('items');
                } 
            }
        }
        foreach ($orders as $key => $order) {
            foreach ($order->items as $key => $orderitem) {
                if($id != $orderitem->id) {
                    File::delete(public_path('upload/'.$item->image));
                    $item->delete();
                    session()->flash('candelete');
                    return redirect('items');
                }
            }
        }
    }

    public function itemssearch(FormSearchRequest $request)
    {
        $search = $request->search;
        $items = Item::where('name','like','%'.$search.'%')
        ->orderBy('name')
        ->paginate(15);
        if(count($items) != 0 ) {
            return view('items.index',compact('items'));
        } else {
            session()->flash('itemnotmatch');
            return redirect('items');
        }
    }
}
