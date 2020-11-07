@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li><a href="/orderlist">Order List</a></li>
		<li>Order Detail</li>
	</ol>
	<div class="row">
		<center>
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading "> <i class="fa fa-user" aria-hidden="true"></i> Customer Details </div>
					<div class="panel-body">
						<div class="table table-responsive">
							<table class="table">
								<tr>
									<td style="width: 1%;"><i class="fa fa-user fa-fw" style="font-size:20px; color:#226ee8;"></i></button></td>
									<td>{{$order->user->name}}</td>
								</tr>

								<tr>
									<td style="width: 1%;"><i class="fa fa-envelope-o fa-fw" style="font-size:20px; color:#226ee8;"></i></button></td>
									<td>{{$order->user->email}}</td>
								</tr>

								<tr>
									<td style="width: 1%;"><i class="fa fa-phone" style="font-size:20px; color:#226ee8;"></i></button></td>
									<td>{{$order->phone_number}}</td>
								</tr>

								<tr>
									<td style="width: 1%;"><i class="fa fa-address-card-o" style="font-size:20px; color:#226ee8;"></i></button></td>
									<td>{{$order->address}}</td>
								</tr>

							</table>
						</div>
					</div>
				</div>
			</div>
		</center>
		<div class="col-md-12 orderform">
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-info-circle"></i> Order(#{{$order->id}}) </div>
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