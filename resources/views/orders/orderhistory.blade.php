@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li>Order History</li>
	</ol>
	<div class="table-responsive">
		<legend>All Order</legend>
		<div style="margin-bottom: 10px;">
			<form action="{{ url('filterorder') }}" method="post">
				@csrf
				<div class="input-group btn-block ">
					<select name="orderfilter" class="form-control pull-right" style="width: 120px;">
						<option value="allhistory">All History</option>
						<option value="washing">Washing</option>
						<option value="delievered">Delivered</option>
						<option value="nodeliever">Ready to Deliver</option>
					</select>
					<span class="input-group-btn">
						<input type="submit" value="Filter" class="btn btn-primary">
					</span>
				</div>
			</form>
		</div>
		<table class="table">
			<tr>
				<th>#</th>
				<th>Customer</th>
				<th>Total</th>
				<th>Pickup Date</th>
				<th>Delivery Date</th>
				<th>Working State</th>
				<th></th>
			</tr>
			@if(count($orders) == 0)
			<tr>
				<th colspan="7" class="text-danger text-center"> No Order History List! </th>
			</tr>
			@else
			@php
			$count = 1;
			@endphp
			@foreach($orders as $order)
			<tr>
				<td>{{$count++}}</td>
				<td>{{$order->user->name}}</td>
				<td>{{$order->amount}}</td>
				<td>{{$order->pickup_date->format('d-m-Y')}}</td>
				<td>{{$order->delivery_date->format('d-m-Y')}}</td>
				<td>
					@if($order->wash == 0)
					<p class="text-primary">washing</p>
					@elseif($order->deliver == 1)
					<p class="text-success">delivered</p>
					@elseif($order->deliver == 0 && $order->wash == 1)
					<p class="text-warning">Ready to Deliver</p>
					@endif
				</td>
				<td>
					<a href="{{ url('orderdetail',$order->id) }}" class="btn btn-info btn-sm">Detail</a>
				</td>
			</tr>
			@endforeach
			@endif
		</table>
	</div>
	{{$orders->links()}}
</div>

@endsection