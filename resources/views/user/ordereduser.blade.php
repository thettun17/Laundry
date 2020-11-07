@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li>Order List</li>
	</ol>
	<div class="table-responsive">
		<legend>Order List</legend>
		<table class="table">
			<tr>
				<th>#</th>
				<th>Customer</th>
				<th>Total</th>
				<th>PickUp Date</th>
				<th>Delivery Date</th>
				<th></th>
			</tr>
			@if(count($orders) == 0)
			<tr>
				<th colspan="6" class="text-danger text-center"> No Order Now! </th>
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
				<td><a href="{{ url('orderdetail',$order->id) }}" class="btn btn-info btn-sm">Detail</a></td>
			</tr>
			@endforeach
			@endif
		</table>
	</div>
	{{$orders->links()}}
</div>
@endsection
