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
                    <!-- resources/views/auth/password.blade.php -->
                    <form role="form" class="form-horizontal" method="POST" action="/password/email">
                        {!! csrf_field() !!}
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <br>
                        <div class="form-group">
                            <label class="control-label">Email Address</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                                   placeholder="user@email.com">
                        </div>
                        <br>
                        <button class="btn btn-primary btn-sm" type="submit">Send Password Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
