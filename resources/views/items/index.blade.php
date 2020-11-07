@extends('layouts.dashboard')
@section('content')
<div class="container">
	@if(Auth::check())
	@if(Auth::user()->isadmin())
	<form action="{{url('itemsearch')}}" method="post">
		@if ($errors->has('search'))
		<span class="pull-right invalid-feedback">
			<strong>{{ $errors->first('search') }}</strong>
		</span>
		@endif
		{{csrf_field()}}
		<div class="input-group btn-block ">
			<input type="text" placeholder="Search" name="search" required class="form-control pull-right {{ $errors->has('search') ? ' is-invalid' : '' }}" style="width: 200px;">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
			</span>
		</div>	
	</form>

	@endif
	@endif
	@if (session('addsuccess'))
	<p class="alert alert-success">{{session('addsuccess')}}</p>
	@endif 
	<!-- ROle -->
	<div class="row">
		@foreach($items as $item)
		<div class="col-sm-3 cart">
			<div class="col-item">
				<div class="photo">
					<img src="{{asset('/upload/'.$item->image)}}" />
				</div>
				<div class="info">
					<div class="row">
						<div class="price col-md-12">
							<h5>{{ $item->name }}</h5>
							<h5 class="price-text-color">{{ $item->price }}</h5>
						</div>
					</div>
					<div class="separator clear-left">
						@if(Auth::check())
						@if(Auth::user()->isAdmin())
						<p>
							<a href="{{url('item/edit',$item->id)}}" class="btn btn-info btn-sm">Edit</a>
							<a href="{{url('item/delete',$item->id)}}" class="btn btn-danger btn-sm">Delete</a>
						</p>
						@else
						<p>
							<a href="{{ url('additem',$item->id) }}" class="hidden-sm btn btn-success btn-sm"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</p>
						@endif
						@endif
					</div>
					<div class="clearfix">
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection
@section('scripts')
<script>
	@if(session()->has('noitem'))
	swal('No Items Bucket!','Please Choose Some Items','error');
	@elseif(session()->has('ordersuccess'))
	swal('Thank You!','Your Order is Successfully','success');
	@elseif(session()->has('itemcreated'))
	swal('Success!', 'Item Created Successfully', 'success');
	@elseif(session()->has('itemupdated'))
	swal('Success!','Item {{session('itemupdated')}} Successfully Updated','success');
	@elseif(session()->has('nodelete'))
	swal('No!','This item can not delete.','error');
	@elseif(session()->has('candelete'))
	swal('Success!','Item Deleted Successfully.','success');
	@elseif(session()->has('itemnotmatch'))
	swal('Items not match!','The item you search does not found.','error');
	@endif
</script>
@endsection