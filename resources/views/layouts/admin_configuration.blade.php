@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px">
            <!-- login -->
            <div class="col-sm-12">
                <div class="login-pane">
                    <h2 class="title-header">Admin Configuration</h2>
                    <form role="form" class="form-horizontal row" id="frm-admin_config-register">
                        <h3 class="title-header">Free Tokens</h3>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Registration Tokens</label>
                            <input maxlength="2" id="txt-admin_config-register-token" type="text"
                                   placeholder="Registration Tokens" class="form-control admin_config-numeric"
                                   value="{{ $config->register_tokens }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Referral Tokens</label>
                            <input maxlength="2" id="txt-admin_config-refer-token" type="text"
                                   placeholder="Referral Tokens" class="form-control admin_config-numeric"
                                   value="{{ $config->refer_tokens }}">
                        </div>
                        <h3 class="title-header">Paypal Integration</h3>
                        <div class="alert alert-danger hoseh-danger">- UPDATING THESE FIELDS MIGHT CAUSE THE SYSTEM TO
                            NOT WORK PROPERLY -
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Client ID</label>
                            <input id="txt-admin_config-paypal-paypal-client-id" type="text" placeholder="Client ID"
                                   class="form-control" value="{{ $config->paypal_paypal_client_id }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Secret</label>
                            <input id="txt-admin_config-paypal-secret" type="text" placeholder="Secret"
                                   class="form-control" value="{{ $config->paypal_secret }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Mode</label>
                            <input id="txt-admin_config-paypal-mode" type="text" placeholder="Mode" class="form-control"
                                   value="{{ $config->paypal_mode }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">End Point</label>
                            <input id="txt-admin_config-paypal-end-point" type="text" placeholder="End Point"
                                   class="form-control" value="{{ $config->paypal_end_point }}">
                        </div>
                        <h3 class="title-header">SMS Service Integration</h3>
                        <div class="form-group col-sm-6">
                            <label class="control-label">User Name</label>
                            <input id="txt-admin_config-sms-user-name" type="text" placeholder="User Name"
                                   class="form-control" value="{{ $config->sms_user_name }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Password</label>
                            <input id="txt-admin_config-sms-user-password" type="text" placeholder="Password"
                                   class="form-control" value="{{ $config->sms_user_password }}">
                        </div>
                    </form>
                    <div class="alert alert-danger hoseh-danger">- UPDATING THESE FIELDS MIGHT CAUSE THE SYSTEM TO NOT
                        WORK PROPERLY -
                    </div>
                    <a id="btn-admin_config-update" class="pull-right btn btn-primary" type="button">Update</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        $(".admin_config-numeric").keydown(function (e) {
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
            if ($(this).val().length > 2) {
                e.preventDefault();
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $("#btn-admin_config-update").on('click', function () {
            $.post('/c/u', {
                'reg_t': xssFilter($("#txt-admin_config-register-token").val()),
                'ref_t': xssFilter($("#txt-admin_config-refer-token").val()),
                'client_id': xssFilter($("#txt-admin_config-paypal-paypal-client-id").val()),
                'secret': xssFilter($("#txt-admin_config-paypal-secret").val()),
                'mode': xssFilter($("#txt-admin_config-paypal-mode").val()),
                'end_point': xssFilter($("#txt-admin_config-paypal-end-point").val()),
                'sms_name': xssFilter($("#txt-admin_config-sms-user-name").val()),
                'sms_password': xssFilter($("#txt-admin_config-sms-user-password").val())
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
                        window.location.href = '/c';
                    });
                }
            });
        });
    </script>


@endsection
