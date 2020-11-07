@extends('layouts.dashboard')
@section('content')
<center><legend>Edit Point</legend></center>
<div class="container">
	<form action="{{ url('points',$point->id) }}" method="post">
		{{ csrf_field() }}
		{{ method_field('put') }}
		<div class="form-group">
			<label>Type</label>
			<input type="text" name="type" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" value="{{$point->type}}">
			@if ($errors->has('type'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('type') }}</strong>
			</span>
			@endif
		</div>
		<div class="form-group">
			<label>Amount</label>
			<input type="text" name="amount" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{$point->amount}}">
			@if ($errors->has('amount'))
			<span class="invalid-feedback ">
				<strong>{{ $errors->first('amount') }}</strong>
			</span>
			@endif
		</div>
		<input type="submit" value="Update" class="btn btn-info btn-sm">
	</form>
</div>
@endsection