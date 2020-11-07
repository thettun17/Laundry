@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="items">Home</a></li>
		<li>Basket List</li>
	</ol>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $item)
				<tr>
					<td> {{ $item['name'] }} </td>
					<td> {{ $item['price'] }} </td>
					<td>
						@if ($errors->has('quantity'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('quantity') }}</strong>
						</span>
						@endif
						<form action="{{url('updatesession',$item['id'])}}" method="get">
							{{csrf_field()}}
							<input type="number" name="quantity" value="{{$item['quantity']}}" class="{{ $errors->has('quantity') ? ' is-invalid' : '' }}" >
							<input type="submit" value="Update" class="btn btn-info btn-sm">

							<a href="{{url('deletesession',$item['id'])}}" class="btn btn-danger btn-sm">Remove</a>

						</form>
					</td>
					<td>{{$item['totalprice']}}</td>

				</tr>
				{{session()->push('basketsession',$item)}}
				@endforeach

				<tr>
					<th colspan="3"><span class="pull-right">Total</span></th>
					<th colspan="2">{{ $totalprice }}</th>
					{{session()->put('totalprices',$totalprice)}}

				</tr>

				{{session()->put('remaining',$remaining)}}
			</tbody>
		</table>
	</div>
	<a href="{{url('orders/create')}}" class="btn btn-success btn-sm">Checkout</a>	
	@include('Alerts::show')
	@yield('scripts')

</div>
@endsection

@section('scripts')
<script>
	@if(session()->has('pointlow'))
	swal('Your Point is Low','Please buy some points','warning');
	@endif
</script>
@endsection