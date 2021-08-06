@extends('layouts.master')

@section('content')

<div class="container">
  <br>
  <div class="row" style="margin-top: 50px">
    <!-- login -->
    <div class="col-sm-12">
      <div class="login-pane" style="min-height: 500px;">
        <br>
          <h1 class="title-header">Password Reset</h1>
          <form role="form" class="form-horizontal" method="POST" action="/password/reset">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
              <label class="control-label">Email Address</label>
              <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="user@email.com">
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <input name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input name="password_confirmation" type="password" placeholder="Confirm Password" class="form-control">
            </div>
            <div class="alert alert-danger hoseh-danger">Login in is required after password reset</div>
            <br>
            <button class="btn btn-primary" type="submit">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
