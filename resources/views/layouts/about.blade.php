@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px">
            <!-- login -->
            <div class="col-sm-12">
                <div class="login-pane">
                    <div id="about-pane">
                        {!!  $details['about']  !!}
                    </div>
                    @if(session('user_id') == 1)
                        <br>
                        <a href="#" id="btn-about-update" class="btn btn-primary pull-right" type="button">Update
                            Details</a>
                        <br>
                        <br>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(session('user_id') == 1)
        <script>
            $('.about').attr('contenteditable', 'true');
            $('#btn-about-update').on('click', function () {
                var a = $('#about-pane').html();
                $.post('/a/u', {
                    'a': a
                }, function (rx) {
                    swal({
                        title: xssFilter(rx[1]),
                        type: xssFilter(rx[2]),
                        timer: 10000,
                        showConfirmButton: true
                    });
                });
            });
        </script>
    @else
        <script>
            $('.about').attr('contenteditable', 'false');
        </script>
    @endif

@endsection
