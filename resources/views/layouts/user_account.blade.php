@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px">
            <!-- login -->
            <div class="col-sm-12">
                <div class="login-pane">
                    <h1 class="title-header">User Account</h1>
                    <form role="form" class="form-horizontal row" id="frm-user_account-register">
                        <h5 class="col-sm-12">Personal Information</h5>
                        @if(session('user_id') == 1)
                          <div class="form-group col-sm-12">
                              <label class="control-label">User ID</label>
                              <input id="txt-user_account-id" type="text" placeholder="ID"
                                     class="form-control" readonly="readonly" value="{{ $user->id }}">
                          </div>
                        @endif
                        <div class="form-group col-sm-6">
                            <label class="control-label">First Name</label>
                            <input id="txt-user_account-first-name" type="text" placeholder="First Name"
                                   class="form-control" readonly="readonly" value="{{ $user->first_name }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Last Name</label>
                            <input id="txt-user_account-last-name" type="text" placeholder="Last Name"
                                   class="form-control" readonly="readonly" value="{{ $user->last_name }}">
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Nick Name</label>
                            <input id="txt-user_account-nick-name" type="text" placeholder="Nick Name"
                                   class="form-control" readonly="readonly" value="{{ $user->nick_name }}">
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon">&nbsp&nbsp@&nbsp</span>
                                <input id="txt-user_account-email" type="text" class="form-control" placeholder="Email"
                                       readonly="readonly" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Receive News/Promotions Email</label>
                            <div class="input-group">
                                <input id="txt-user_account-promo" type="text" class="form-control" placeholder="Receive News/Promotions Email"
                                       readonly="readonly" value="{{ $user->send_promo ? 'Yes' : 'No' }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-addon">+65</span>
                                <input id="txt-user_account-mobile" type="text" class="form-control"
                                       placeholder="Mobile Number" readonly="readonly"
                                       value="{{ substr($user->mobile, 2) }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Gender</label>
                            <div>
                                @if($user->gender)
                                    <label class="gender-radio"><input type="radio" name="rdo-user_account-gender"
                                                                       gender="1" checked="checked" disabled="true">Male</label>
                                    <label class="gender-radio"><input type="radio" name="rdo-user_account-gender"
                                                                       gender="0" disabled="true">Female</label>
                                @else
                                    <label class="gender-radio"><input type="radio" name="rdo-user_account-gender"
                                                                       gender="1" disabled="true">Male</label>
                                    <label class="gender-radio"><input type="radio" name="rdo-user_account-gender"
                                                                       gender="0" checked="checked" disabled="true">Female</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Birthday</label>
                            <input id="txt-user_account-birthday" type="text" placeholder="Birthday"
                                   class="form-control" readonly="readonly" value="{{ $birthday }}">
                            <div class="alert alert-danger hoseh-danger">You need to be above 18 to participate in our
                                auctions.
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Delivery Address</label>
                            @if(session('user_id') != 1)
                                <textarea rows="4" cols="50" id="txt-user_account-address" type="text"
                                          placeholder="Delivery Address"
                                          class="form-control">{{ $user->address }}</textarea>
                            @else
                                <textarea rows="4" cols="50" id="txt-user_account-address" type="text"
                                          placeholder="Delivery Address" readonly="readonly"
                                          class="form-control">{{ $user->address }}</textarea>
                            @endif
                            <br>
                            @if(session('user_id') != 1)
                                <a id="btn-user_account-update-address" class="btn btn-primary" type="button">Update
                                    Address</a>
                            @endif
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Tokens</label>
                            @if(session('user_id') != 1)
                              <input id="txt-user_account-token" type="text" placeholder="Token" class="form-control"
                                     readonly="readonly" value="{{ $user->tokens }}">
                              <br>
                            @else
                            <input id="txt-user_account-token" type="text" placeholder="Token" class="form-control"
                                  value="{{ $user->tokens }}">
                            <br>
                            @endif
                            @if(session('user_id') != 1)
                              <a href="/u/p/s" id="btn-user_account-buy-tokens" class="btn btn-primary" type="button">Buy
                                  Tokens</a>
                            @else
                              <a id="btn-user_account-update-tokens" class="btn btn-primary" type="button">Update
                                  Tokens</a>
                            @endif

                        </div>
                        @if(session('user_id') != 1)
                            <div class="form-group col-sm-12">
                                <label class="control-label">Current Password</label>
                                <input id="txt-user_account-password-1" type="password" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="control-label">New Password</label>
                                <input id="txt-user_account-password-2" type="password" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="control-label">Confirm New Password
                                </label>
                                <input id="txt-user_account-password-3" type="password" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <a href="#" id="btn-user_account-update" class="btn btn-primary" type="button">Update
                                    Password</a>
                            </div>
                        @endif
                        @if(session('user_id') == 1)
                            <a href="#" id="btn-user_account-back" class="btn btn-primary pull-right" type="button"
                               onclick="goBack()">&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('user_id') != 1)
        <script type="text/javascript">

            $("#btn-user_account-update-address").on('click', function () {

                $.post('/u/u/a', {
                    'a': xssFilter($("#txt-user_account-address").val())
                }, function (rx) {
                    if (!rx[0]) {
                        swal({
                            title: xssFilter(rx[1]),
                            timer: 10000,
                            showConfirmButton: true
                        });
                    }
                    else {
                        swal({
                            title: xssFilter(rx[1]),
                            text: xssFilter(rx[2]),
                            timer: 30000,
                            showConfirmButton: true
                        });
                    }
                });

            });

            $("#btn-user_account-update").on('click', function () {

                $.post('/u/u/s', {
                    'p1': xssFilter($("#txt-user_account-password-1").val()),
                    'p2': xssFilter($("#txt-user_account-password-2").val()),
                    'p3': xssFilter($("#txt-user_account-password-3").val())
                }, function (rx) {
                    if (!rx[0]) {
                        swal({
                            title: xssFilter(rx[1]),
                            timer: 10000,
                            showConfirmButton: true
                        });
                    }
                    else {
                        swal({
                            title: xssFilter(rx[1]),
                            text: xssFilter(rx[2]),
                            timer: 30000,
                            showConfirmButton: true
                        }, function () {
                            window.location.href = '/u/u';
                        });
                    }
                });

            });
        </script>
    @else
        <script>
            function goBack() {
                window.history.back();
            }

            $("#txt-user_account-token").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                        // Allow: Ctrl+A, Command+A
                        (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
                        // Allow: home, end, left, right, down, up
                        (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ($(this).val().length > 8) {
                    e.preventDefault();
                }
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            $("#btn-user_account-update-tokens").on('click', function () {
              swal({
                  title: "Update User Token?",
                  text: "Are you sure you want to update the token amount for this user?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Update",
                  closeOnConfirm: false
              },
              function () {
                $.post('/u/p/u/u/t', {
                    'u':  xssFilter($("#txt-user_account-id").val()),
                    't': xssFilter($("#txt-user_account-token").val())
                }, function (rx) {
                    if (!rx[0]) {
                        swal({
                            title: xssFilter(rx[1]),
                            timer: 10000,
                            showConfirmButton: true
                        });
                    }
                    else {
                        swal({
                            title: xssFilter(rx[1]),
                            text: xssFilter(rx[2]),
                            timer: 30000,
                            showConfirmButton: true
                        });
                    }
                });
                });
            });
        </script>
    @endif

@endsection
