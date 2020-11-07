@extends('layouts.dashboard')
@section('content')
<div class="contactheader">
	<button class="aboutbutton btn btn-md">ABOUT US</button>
	<ul class="aboutuslink"> 
		<li class="alink"><a class="linka" href="{{ url('items') }}"> Home \</a> <span>About Us</span></li> 
	</ul>
</div>
<div class="container">
	<center><h1 class="whatwedo">WHAT WE DO</h1></center>
	<div class="row">
		<div class="col-md-4 wash">
			<div class="panel panel-default">
				<img src="https://www.wikihow.com/images/thumb/5/57/Wash-Your-Clothes-With-Dish-Liquid-Step-2.jpg/aid1126400-v4-728px-Wash-Your-Clothes-With-Dish-Liquid-Step-2.jpg" class="img-responsive">
				<div class="panel-footer text-center aboutusfooter">Washed!</div>
			</div>
		</div>
		<div class="col-md-4 iron">
			<div class="panel panel-default">
				<img src="https://dailyfamily.ng/wp-content/uploads/2017/07/meet-the-6-most-common-mistakes-we-make-while-ironing.jpg" class="img-responsive">
				<div class="panel-footer text-center aboutusfooter">
					Ironed!
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<img src="https://static1.squarespace.com/static/55c2c8bfe4b000005de41843/t/56e86fd62fe131c1359edf05/1458073562516/?format=750w" class="img-responsive">
				<div class="panel-footer text-center aboutusfooter">
					Delivered!
				</div>
			</div>
		</div>
	</div>
</div>
<div class="phone text-center"> 
	CALL US <br> 09-965933846,09-457706471 </a>
</div>
<div class="container" style="margin-top: 30px;">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3321.1090474094153!2d96.12583931443191!3d16.809160123648667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1eb39d854cf01%3A0x3339d351468aec9d!2sThe+Cyber+Wings+Team!5e1!3m2!1sen!2smm!4v1533655142267" width="1200" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
@endsection