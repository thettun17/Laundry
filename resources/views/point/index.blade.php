@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="items">Home</a></li>
		<li>Points</li>
	</ol>
	<div class="row">
		@foreach($points as $point)
		<div class="col-md-4">

			<!-- PRICE ITEM -->
			<div class="panel price panel-grey">
				<div class="panel-heading arrow_box text-center">
					<h3>Point Package</h3>
				</div>
				<div class="panel-body text-center">
					<p class="lead" style="font-size:40px"><strong>{{$point->type}} Kyats</strong></p>
				</div>
				<ul class="list-group list-group-flush text-center ulcontent">
					<li class="list-group-item"><i class="icon-ok text-success"></i> Personal use</li>
					<li class="list-group-item"><i class="icon-ok text-success"></i>{{$point->amount}} points</li>
				</ul>
				<div class="panel-footer">
					@if(Auth::check())
					@if(Auth::user()->isAdmin())
					<form action="{{ url('points',$point->id) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<a href="{{url('points/'.$point->id.'/edit')}}" class="btn btn-block btn-info">Edit</a>
						<input type="submit" value="Delete" class="btn btn-block btn-danger">
					</form>
					@else
					<a class="btn btn-lg btn-block btn-primary confirm" href="{{ url('buypoint',$point->id) }}">BUY NOW!</a>
					@endif
					@endif
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		$(".confirm").click(function(event){
			event.preventDefault();
			swal({
				title: "Are you sure?",
				icon: "warning",
				buttons: true,
			})
			.then((result) => {
				console.log(result);
				if (result) {
					window.location = this.href;
				}
			});
		});
	});
	@if(session()->has('pointcreate'))
	swal('Success!', 'Point Created Successfully', 'success');
	@elseif(session()->has('pointupdated'))
	swal('Success!', 'Point type {{ session('pointupdated') }} updated Successfully', 'success');
	@elseif(session('pointdelted'))
	swal('Success!', 'Point deleted Successfully', 'success');
	@elseif(session()->has('pointbought'))
	swal('Successfully bought ','Now Your Point Amount is {{ session('pointbought')}} ','success');
	@endif
</script>
@endsection