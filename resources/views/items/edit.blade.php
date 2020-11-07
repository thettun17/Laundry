@extends('layouts.dashboard')
@section('content')
<div class="container">
	<form action="{{url('item/update',$item->id)}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}

		<div class="form-group">
			<label>Item Name:</label>
			<input type="text" name="name" value="{{$item->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
			@if ($errors->has('name'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
			@endif
		</div>

		<div class="form-group">
			<label>Item Price</label>
			<input type="text" name="price" value="{{$item->price}}" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}">
			@if ($errors->has('price'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('price') }}</strong>
			</span>
			@endif
		</div>

		<div class="form-group">
			<label> Select image to upload:</label>
			<input type="file" name="image" >
			<img src="{{asset('/upload/'.$item->image)}}" class="img-responsive" width="200" height="300">
		</div>

		<button type="submit" class="btn btn-primary btn-sm">Update</button>
	</form>
</div>
@endsection