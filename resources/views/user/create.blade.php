@extends('layouts.dashboard')
@section('content')
<div class="container">
	<legend>Add New User</legend>
	<form method="post" action="{{ url('storeuser') }}">
		@csrf
		<div class="form-group row">
			<label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Display Name') }}</label>

			<div class="col-md-7">
				<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

				@if ($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

			<div class="col-md-7">
				<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

				@if ($errors->has('email'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

			<div class="col-md-7">
				<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

				@if ($errors->has('password'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

			<div class="col-md-7">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Role') }}</label>

			<div class="col-md-7">
				<select name="role" class="form-control" id="role">
					<option value="1"> Admin </option>
					<option value="0"> User </option>
				</select>
			</div>
		</div>

		<div class="form-group row mb-0">
			<label class="col-md-3 col-form-label text-md-right"></label>
			<div class="col-md-7">
				<button type="submit" class="btn btn-primary btn-sm">
					{{ __('Register') }}
				</button>
			</div>
		</div>
	</form>
</div>
@endsection