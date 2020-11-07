@extends('layouts.dashboard')
@section('content')
<div class="container col-md-offset-3 col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">{{ __('Change Name') }}</div>
      <div class="panel-body">
          <form method="POST" action="{{url('changename')}}">
            @csrf
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Name</label>
                <div class="col-md-7">
                    <input type="text" name="changename" value="{{Auth::user()->name}}" class="form-control{{ $errors->has('changename') ? ' is-invalid' : '' }}">
                    @if ($errors->has('changename'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('changename') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row mb-0">
                <label class="col-md-3 col-form-label text-md-right"></label>
               <div class="col-md-7">
                <input type="submit" value="Change Name" class="btn btn-primary btn-sm">
            </div>
        </div>
    </form>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
    @if(session()->has('changedname'))
    swal("{{ session('changedname') }}" , 'Successfully Changed.' , 'success');
    @endif
</script>
@endsection