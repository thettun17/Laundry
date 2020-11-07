@extends('layouts.dashboard')
@section('content')
<div class="container">
 <ol class="breadcrumb">
 	<li><a href="/items">Home</a></li>
 	<li>Create Point</li>
 </ol>
	<form action="{{ url('points') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label>Type</label>
			<input type="text" name="type" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" value="{{ old('type') }}" required>
			@if ($errors->has('type'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('type') }}</strong>
			</span>
			@endif
		</div>
		
		<div class="form-group">
			<label>Amount</label>
			<input type="text" name="amount" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount') }}" required>
			@if ($errors->has('amount'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('amount') }}</strong>
			</span>
			@endif
		</div>
		<div class="form-group ">
			<input type="submit" value="Create" class="btn btn-info btn-sm">
		</div>
	</form>
</div>
@endsection