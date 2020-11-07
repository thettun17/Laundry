<?php

namespace App\Http\Controllers;
use App\Http\Requests\PointRequest;
use Redirect;
use App\Point;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class PointController extends Controller
{
    public function __construct()
    {
       $this->middleware('pointmiddleware',['except' => ['index','buypoint']]);
       $this->middleware('auth');
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $points = Point::orderBy('amount')->get();
        return view('point.index',compact('points'));
    }
    

    public function create()
    {
        return view('point.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PointRequest $request)
    {
        Point::create($request->all());
        session()->flash('pointcreate');
        return redirect('points');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        return view('point.edit',compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(PointRequest $request, Point $point)
    {
        $point->update($request->all());
        session()->flash('pointupdated' , $point->type);
        return redirect('points');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
       $point->delete();
       session()->flash('pointdelted');
       return redirect('points');
   }
   public function buypoint($id)
   {
   // dd('lso');
    $userid = Auth::user()->id;
    $point = Point::findOrFail($id);
    $user = User::find($userid);
    $amount = $point->amount;
    $useramount =  $user->point_amount;
    $total = $amount+$useramount;
    $user->point_amount = $total;
    $user->save();
    session()->flash('pointbought' , $user->point_amount);
    return redirect('points');
}
}
