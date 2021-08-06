@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px;">
            <div class="login-pane" style="padding: 10px;">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#">Testimonials</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="login-pane" style="min-height: 500px;">
                    <h1 class="title-header">User's Testimonials</h1>
                    <div class="report-container">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Message
                                </th>
                                <th>

                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($testimonials['testimonials']))
                                @foreach($testimonials['testimonials'] as $testimonial)
                                    <tr>
                                        <td>
                                            <input maxlength="30"
                                                   id="txt-user_testimonial-name-{{ $testimonial['testimonial_id'] }}"
                                                   type="text" placeholder="Name"
                                                   class="form-control txt-user_testimonial-name"
                                                   value="{{ $testimonial['name'] }}">
                                        </td>
                                        <td>
                                            <textarea maxlength="255" rows="4" cols="50"
                                                      id="txt-user_testimonial-message-{{ $testimonial['testimonial_id'] }}"
                                                      type="text" placeholder="Message"
                                                      class="form-control txt-user_testimonial-message">{{ $testimonial['message'] }}</textarea>
                                        </td>
                                        <td class="report-table">
                                            <img class="product-report-thumbnail"
                                                 src="{{ asset($testimonial['image']) }}"/>
                                            <form data-ajax="false"
                                                  id="frm-user_testimonial-image-img-{{ $testimonial['testimonial_id'] }}"
                                                  action="/u/t/ai?t={{ $testimonial['testimonial_id'] }}" method="POST"
                                                  enctype="multipart/form-data" name="form">
                                                {{ csrf_field() }}
                                                <input id="txt-user_testimonial-image-id" class="hide" name="t"
                                                       value="/u/t|{{ $testimonial['testimonial_id'] }}"
                                                       data-id="{{ $testimonial['testimonial_id'] }}">
                                                <input id="txt-user_testimonial-image-img-path-{{ $testimonial['testimonial_id'] }}"
                                                       data-id="{{ $testimonial['testimonial_id'] }}" type="file"
                                                       class="hide txt-user_testimonial-image-img-path" name="image"
                                                       onChange="user_testimonial_img_path_change_image({{ $testimonial['testimonial_id'] }});"
                                                       accept="image/jpeg,image/x-png"/>
                                                <button type="button" id="btn-user_testimonial-image-add-image"
                                                        onclick="user_testimonial_img_path_click_image({{ $testimonial['testimonial_id'] }});"
                                                        style="width:40%; margin-top:5px;">
                                                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm report-action user-testimonial-update"
                                                    type="button" data-id="{{ $testimonial['testimonial_id'] }}">Update
                                            </button>
                                            <br>
                                            <button class="btn btn-primary btn-sm report-action user-testimonial-delete"
                                                    type="button" data-id="{{ $testimonial['testimonial_id'] }}">Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td>
                                    <input maxlength="30" id="txt-user_testimonial-name" type="text" placeholder="Name"
                                           class="form-control" value="">
                                </td>
                                <td>
                                    <textarea maxlength="255" rows="4" cols="50" id="txt-user_testimonial-message"
                                              type="text" placeholder="Message" class="form-control"></textarea>
                                </td>
                                <td class="report-table">
                                    <img class="product-report-thumbnail" src="{{ asset('img/' . 'no-image.png') }}"/>
                                </td>
                                <td>
                                    <button id="btn-user_testimonial-add-new"
                                            class="btn btn-primary btn-sm report-action" type="button">Add New
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="pagination"> {{ $testimonials['users_testimonial_history'] }} </div>
                    <br>
                    <h2 class="title-header">Total: {{ $testimonials['users_testimonial_total'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btn-user_testimonial-add-new').on('click', function () {
            $.post('/u/t/a', {
                'n': xssFilter($('#txt-user_testimonial-name').val()),
                'm': xssFilter($('#txt-user_testimonial-message').val())
            }, function (rx) {
                if (!rx[0]) {
                    swal({
                        title: xssFilter(rx[1]),
                        timer: 10000,
                        type: 'error',
                        showConfirmButton: true
                    });
                }
                else {
                    swal({
                        title: rx[1],
                        text: rx[2],
                        type: 'success',
                        timer: 30000,
                        showConfirmButton: true
                    }, function () {
                        window.location.href = '/u/t';
                    });
                }
            });
        });

        $('.user-testimonial-update').on('click', function (e) {
            var id = $(e.target).data('id');

            $.post('/u/t/u', {
                't': xssFilter(id),
                'n': xssFilter($('#txt-user_testimonial-name-' + id).val()),
                'm': xssFilter($('#txt-user_testimonial-message-' + id).val())
            }, function (rx) {
                if (!rx[0]) {
                    swal({
                        title: xssFilter(rx[1]),
                        timer: 10000,
                        type: 'error',
                        showConfirmButton: true
                    });
                }
                else {
                    swal({
                        title: rx[1],
                        text: rx[2],
                        type: 'success',
                        timer: 30000,
                        showConfirmButton: true
                    }, function () {
                        window.location.href = '/u/t';
                    });
                }
            });
        });

        $('.user-testimonial-delete').on('click', function (e) {
            var id = $(e.target).data('id');
            swal({
                        title: "Delete Testimonial?",
                        text: "Are you sure you want to delete this testimonial?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        closeOnConfirm: false
                    },
                    function () {
                        $.post('/u/t/d', {
                            't': xssFilter(id)
                        }, function (rx) {
                            if (!rx[0]) {
                                swal({
                                    title: xssFilter(rx[1]),
                                    timer: 10000,
                                    type: 'error',
                                    showConfirmButton: true
                                });
                            }
                            else {
                                swal({
                                    title: rx[1],
                                    text: rx[2],
                                    type: 'success',
                                    timer: 30000,
                                    showConfirmButton: true
                                }, function () {
                                    window.location.href = '/u/t';
                                });
                            }
                        });
                    });
        });

        function user_testimonial_img_path_click_image(id) {
            var img_path = document.getElementById("txt-user_testimonial-image-img-path-" + id);
            img_path.click();
        }

        function user_testimonial_img_path_change_image(id) {
            if ($("txt-user_testimonial-image-img-path").val() != '')
                var img_path = document.getElementById("txt-user_testimonial-image-img-path-" + id);
        }

        $(".txt-user_testimonial-image-img-path").change(function (e) {
            var id = $(e.target).data('id');
            $("#frm-user_testimonial-image-img-" + id).submit();
        });

    </script>

@endsection
