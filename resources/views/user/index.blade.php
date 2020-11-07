@extends('layouts.dashboard')
@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/items">Home</a></li>
		<li>Users</li>
	</ol>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created_at</th>
				</tr>
			</thead>
			@php
			$count = 1;
			@endphp
			@foreach($users as $key => $user)
			@if($user->is_admin != 1)
			<tbody>
				<tr>
					<td>{{ $count++ }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->created_at }}</td>
				</tr>
			</tbody>
			@endif
			@endforeach
		</table>
	</div>
</div>
@endsection