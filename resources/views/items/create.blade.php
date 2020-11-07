@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li>Items Create</li>
	</ol>
	<form action="{{ url('items/store') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
			@if ($errors->has('name'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
			@endif
		</div>

		<div class="form-group">
			<label>Price</label>
			<input type="text" name="price" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" required>
			@if ($errors->has('price'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('price') }}</strong>
			</span>
			@endif
		</div>

		<div class="form-group">
			<label> Select image to upload:</label>
			<input type="file" name="image" required >
		</div>

		<div class="form-group">
			<button class="btn btn-info">Create</button>
		</div>
		
	</form>
</div>

@endsection