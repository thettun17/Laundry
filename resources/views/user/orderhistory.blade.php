@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="items">Home</a></li>
		<li>Order History</li>
	</ol>
	<div class="table-responsive">
		<legend>My Order</legend>
		<div style="margin-bottom: 10px;">
			<form action="{{ url('personorderhistory') }}" method="post">
				@csrf
				<div class="input-group btn-block ">
					<select name="userorderhistory" class="form-control pull-right" style="width: 120px;">
						<option value="all">All</option>
						<option value="1">Receive</option>
						<option value="0">Not Receive</option>
					</select>
					<span class="input-group-btn">
						<input type="submit" value="Filter" class="btn btn-primary">
					</span>
				</div>
			</form>
		</div>
		<table class="table table-responsive ">
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
				<td>@if($order->deliver == 1)
					<p style="color:green;">Receive</p>
					@else
					<p style="color: red;">Not Receive</p>
					@endif
				</td>
				<td><a href="{{ url('userorderdetail',$order->id) }}" class="btn btn-info btn-sm">Detail</a></td>
			</tr>
			@endforeach
			@endif
		</table>
	</div>
	{{$orders->links()}}
</div>

@endsection
