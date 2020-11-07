@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="items">Home</a></li>
		<li><a href="{{url('orderhistory')}}">Order History</a></li>
		<li class="active">Detail</li>
	</ol>
<div class="row">
	<div class="col-md-12 orderform">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-info-circle"></i> Order </div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<tr>
							<th>Item Name</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Total</th>
						</tr>
						@foreach ($order->items as $orderitem)
						<tr>
							<td>{{$orderitem->name}}</td>
							<td>{{$orderitem->pivot->quantity}}</td>
							<td>{{$orderitem->pivot->unit_price}}</td>
							<td>{{$orderitem->pivot->total_price}}</td>
						</tr>
						@endforeach
						<tr>
							<th colspan="3">Total</th>
							<th>{{ $order->amount }}</th>
						</tr>
					</table>
				</div>
			</div>
		</div>		
	</div>
</div>
</div>
@endsection