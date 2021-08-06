@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px">
        {{ csrf_field() }}
        <!-- login -->
            <div class="col-sm-5 login-pane">
                <div class="ribbon-wrapper-green">
                    <div class="ribbon-green"><span>TESTING</span></div>
                </div>
                <h1 class="title-header">Login</h1>
                <form role="form" class="form-horizontal" id="frm-user_login-login">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input id="txt-user_login-submit-email" type="text" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input id="txt-user_login-submit-password" type="password" placeholder="Password"
                               class="form-control">
                    </div>
                    <!-- <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember Password
                        </label>
                      </div>
                    </div> -->
                    <div class="form-group">
                        <button id="btn-user_login-submit" class="btn btn-primary" type="button">Login</button>
                        <!-- <a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i> Connect with Facebook</a> -->
                    </div>
                    <div class="form-group">
                        <div class="text-right">
                            <a href="/login/problems">Trouble logging in?</a>
                        </div>
                    </div>
                </form>
                <!--<div class="panel-border">
                  <h2>login with facebook</h2>
                  <a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i> Connect with Facebook</a>
                </div>-->
            </div>
            <!--  -->
            <div class="col-sm-7">
                <div class="login-pane">
                    <div class="ribbon-wrapper-green">
                        <div class="ribbon-green"><span>TESTING</span></div>
                    </div>
                    <h1 class="title-header">New Members</h1>
                    <form role="form" class="form-horizontal row" id="frm-user_login-register">
                        <h5 class="col-sm-12">Personal Information</h5>
                        <div class="form-group col-sm-6">
                            <label class="control-label">First Name</label>
                            <input id="txt-user_login-first-name" type="text" placeholder="First Name"
                                   class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Last Name</label>
                            <input id="txt-user_login-last-name" type="text" placeholder="Last Name"
                                   class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Nick Name</label>
                            <input id="txt-user_login-nick-name" type="text" placeholder="Nick Name"
                                   class="form-control" maxlength="10">
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon">&nbsp&nbsp@&nbsp</span>
                                <input id="txt-user_login-email" type="text" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                              <input type="checkbox" id="chk-user_login-promo" checked="checked"> I agree to receive news and promotional materials from hoseh.com</input>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-addon">+65</span>
                                <input id="txt-user_login-mobile" type="text" class="form-control"
                                       placeholder="Mobile Number" maxlength="8">
                            </div>
                            <div class="alert alert-warning hoseh-danger">Verification code will be sent to this mobile
                                number
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Gender</label>
                            <div>
                                <label class="gender-radio"><input type="radio" name="rdo-user_login-gender" gender="1"
                                                                   checked="checked">&nbsp;&nbsp;&nbsp;Male</label>
                                <label class="gender-radio"><input type="radio" name="rdo-user_login-gender" gender="0">&nbsp;&nbsp;&nbsp;Female</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Birthday</label>
                            <div class="input-group birthdayPicker">
                                <div id="txt-user_login-birthday"></div>
                            </div>
                            <div class="alert alert-danger hoseh-danger">You need to be above 18 to participate in our
                                auctions.
                            </div>
                            <div class="form-group col-sm-12">
                                  <input type="checkbox" id="chk-user_login-age-confirm"> I am over 18 years of age and not prohibited from entering hoseh.com for any reason. </input>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Password</label>
                            <input id="txt-user_login-password-1" type="password" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Confirm Password
                            </label>
                            <input id="txt-user_login-password-2" type="password" class="form-control">
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Referred By</label>
                            <input id="txt-user_login-referred-by" type="text" placeholder="Nick Name"
                                   class="form-control" maxlength="10">
                        </div>
                        <div class="col-sm-12" style="margin-top:10px;">
                            <a href="#" id="btn-user_login-register" class="btn btn-primary pull-right" type="button">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $("#txt-user_login-birthday").birthdayPicker({
            minAge: 18
        });

        $("#btn-user_login-register").on('click', function () {
            if (!$("#chk-user_login-age-confirm").is(':checked')) {
              swal({
                  title: 'Age Verification',
                  text: 'Confirm that you are over 18 years of age and not prohibited from entering hoseh.com for any reason',
                  timer: 10000,
                  showConfirmButton: true
              });
              return;
            }
            swal({
                title: "User Registration",
                text: 'Name: <span style="color:#F8BB86">' + $("#txt-user_login-first-name").val() + ' ' + $("#txt-user_login-last-name").val() + '</span><br>' +
                'NickName: <span style="color:#F8BB86">' + $("#txt-user_login-nick-name").val() + '</span><br>' +
                'Email: <span style="color:#F8BB86">' + $("#txt-user_login-email").val() + '</span><br>' +
                'Mobile: <span style="color:#F8BB86">+65' + $("#txt-user_login-mobile").val() + '</span><br>' +
                'Birthday: <span style="color:#F8BB86">' + $("input[name='txtuser_loginbirthday_birthDay']").attr('value') + '</span><br>' +
                'Referred By: <span style="color:#F8BB86">' + $("#txt-user_login-referred-by").attr('value') + '</span><br>',
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Register",
                html: true,
                showLoaderOnConfirm: true,
            }, function () {
                $.post('/u/r', {
                    'f': xssFilter($("#txt-user_login-first-name").val()),
                    'l': xssFilter($("#txt-user_login-last-name").val()),
                    'n': xssFilter($("#txt-user_login-nick-name").val()),
                    'e': xssFilter($("#txt-user_login-email").val()),
                    'm': xssFilter($("#txt-user_login-mobile").val()),
                    'g': xssFilter($("input[name='rdo-user_login-gender']:checked").attr("gender")),
                    'b': xssFilter($("input[name='txtuser_loginbirthday_birthDay']").attr('value')),
                    'p1': xssFilter($("#txt-user_login-password-1").val()),
                    'p2': xssFilter($("#txt-user_login-password-2").val()),
                    's': xssFilter($("#chk-user_login-promo").is(':checked') ? 1 : 0),
                    'r': xssFilter($("#txt-user_login-referred-by").val())
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
                            title: "Account Verification",
                            text: "Enter code sent to your mobile number ",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "4 digit code"
                        }, function (inputValue) {
                            if (inputValue === false) return false;
                            if (inputValue === "") {
                                swal.showInputError("Verification code required!");
                                return false
                            }
                            $.post('/u/v', {
                                'e': $("#txt-user_login-email").val(),
                                'v': inputValue,
                                'r': xssFilter($("#txt-user_login-referred-by").val())
                            }, function (rx) {
                                if (!rx[0]) {
                                    swal.showInputError(xssFilter(rx[1]));
                                    return false
                                }
                                else {
                                    swal({
                                        title: xssFilter(rx[1]),
                                        text: xssFilter(rx[2]),
                                        type: 'success',
                                        timer: 30000,
                                        showConfirmButton: true
                                    }, function () {
                                        window.location.href = 'login';
                                    });
                                }
                            });
                        });
                    }
                });
            });
        });
        $("#txt-user_login-submit-password").keypress(function (event) {
            if (event.which == 13) {
                $('#btn-user_login-submit').click();
                return false;
            }
        });
        $("#btn-user_login-submit").on('click', function () {
            $.post('/u/l', {
                'e': xssFilter($("#txt-user_login-submit-email").val()),
                'p': xssFilter($("#txt-user_login-submit-password").val())
            }, function (rx) {
                if (!rx[0]) {
                    swal({
                        title: xssFilter(rx[1]),
                        timer: 10000,
                        showConfirmButton: true
                    });
                }
                else {
                    window.location.href = '/';
                }
            });
        });

        $("#txt-user_login-mobile").keydown(function (e) {
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

        $('#txt-user_login-submit-email').focus();
    </script>


@endsection
