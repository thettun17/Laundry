@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li>Deliver List</li>
	</ol>
<div class="table-responsive">
	<legend>Deliver List</legend>
	<table class="table table-bordered">
		<tr>
			<th>#</th>
			<th>Customer</th>
			<th>Address</th>
			<th>Phone Number</th>
			<th>Amount</th>
			<th>Action</th>
		</tr>
		@if(count($orders) == 0)
		<tr>
			<th colspan="6" class="text-danger text-center"> No delivery Lists! </th>
		</tr>
		@else
		@php
		$count =1 ;
		@endphp
		@foreach($orders as $order)
		<tr>
			<td>{{$count++}}</td>
			<td>{{$order->user->name}}</td>
			<td>{{$order->address}}</td>
			<td>{{$order->phone_number}}</td>
			<td>{{$order->amount}}</td>
			<td><a href="{{ url('deliverfinish',$order->id) }}" class="btn btn-success btn-sm">Finish</a></td>
		</tr>
		@endforeach
		@endif
	</table>
</div>
{{$orders->links()}}
</div>
@endsection

@section('scripts')
<script>
	@if(session()->has('deliverlist'))
	swal("{{session('deliverlist')}}",'Successfully delivered!','success');
	@endif
</script>
@endsection