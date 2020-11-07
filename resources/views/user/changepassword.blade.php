@extends('layouts.dashboard')
@section('content')
<div class="container col-md-offset-3 col-md-6">
  <div class="panel panel-default">
    <div class="panel-heading">{{ __('Change Password') }}</div>
    <div class="panel-body">
      <form method="POST" action="{{ url('changepassword') }}" >
        {{ csrf_field() }}
        <div class="form-group">
          <label>Current Password</label>
          <input type="password" name="currentpassword" class="form-control{{ $errors->has('currentpassword') ? ' is-invalid' : '' }}" value="{{ old('currentpassword') }}" required>
          @if ($errors->has('currentpassword'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('currentpassword') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group">
          <label>New Password</label>
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

          @if ($errors->has('password'))
          <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
          <input type="submit" value="Change" class="btn btn-primary btn-sm">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  @if(session()->has('changedpassword'))
  swal('Success!' , 'Password Successfully changed.' , 'success');
  @elseif(session()->has('unchangedpassword'))
  swal(' Password not match!','CurrentPassword Not Match!','error');
  @endif
</script>
@endsection