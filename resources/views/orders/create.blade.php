@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li><a href="/basketLists">Basket List</a></li>
		<li>Order Form</li>
	</ol>
	<legend>Order Form</legend>
	<form action="{{ url('orders/store') }}" method="post" class="container">
			{{ csrf_field() }}
	<div class="form-group">
		<label>Address</label>
		<textarea name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"  value="{{ old('address') }}" autofocus>	
		</textarea>
			@if ($errors->has('address'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('address') }}</strong>
			</span>
			@endif
	</div>

	<div class="form-group">
		<label>Phone Number</label>
		<input type="text" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}">
			@if ($errors->has('phone'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('phone') }}</strong>
			</span>
			@endif
	</div>
	<div class="form-group">
		<label>Pickup_date</label>
		<input type="date" name="pickupdate" class="form-control {{ $errors->has('pickupdate') ? ' is-invalid' : '' }}" value="{{date('Y-m-d', time()+86400)}}" required">
		@if ($errors->has('pickupdate'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('pickupdate') }}</strong>
			</span>
			@endif
	</div>
	<input type="hidden" name="deliverdate" value="{{date('Y-m-d', time()+86400*3)}}">
	<div class="form-group">
		<label>Delivery_date</label>
		<input type="date" name="deliverydate" class="form-control{{ $errors->has('deliverydate') ? ' is-invalid' : '' }}" value="{{date('Y-m-d', time()+86400*4)}}" required>
		@if ($errors->has('deliverydate'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('deliverydate') }}</strong>
			</span>
			@endif
	</div>

	<br>
	<button class="btn btn-info btn-sm">Create Order</button>
	</form>
</div>
@endsection