@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li>Wash List</li>
	</ol>
	<div class="table-responsive">
		<legend>Wash list</legend>
		<table class="table table-bordered">
			<tr>
				<th>Customer</th>
				<th>Delivery Date</th>
				<th>Action</th>
			</tr>
			@if(count($orders) == 0)
			<tr>
				<th colspan="3" class="text-danger text-center"> No Wash List! </th>
			</tr>
			@else
			@foreach($orders as $order)
			<tr>
				<td>{{$order->user->name}}</td>
				<td>{{$order->delivery_date->format('d-m-Y')}}</td>
				<td><a href="{{ url('washfinish',$order->id) }}" class="btn btn-success btn-sm">Finish</a></td>
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
	@if(session()->has('washlist'))
	swal("{{session('washlist')}}",'Successfully washed!','success');
	@endif
</script>
@endsection