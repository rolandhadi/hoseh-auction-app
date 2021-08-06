@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <br>
        @if(session('user_id') != 1)
            <h2>Buy Tokens</h2>
        @else
            <h2>Update Tokens</h2>
        @endif
        <br>
        <section id="pricePlans">
            <ul id="plans">
                <li class="plan">
                    <ul class="planContainer">
                        @if(session('user_id') != 1)
                            <li class="title"><h2></h2></li>
                            <li class="price"><p>Lucky Pack {{ $tokens[1]['count'] }}</p></li>
                        @else
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">Tokens</span>
                                    <input id="txt-buy_token-count-1" type="text" class="form-control"
                                           placeholder="Token Count" value="{{ $tokens[1]['count'] }}">
                                </div>
                            </li>
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;S$&nbsp;&nbsp;&nbsp;</span>
                                    <input id="txt-buy_token-price-1" type="text" class="form-control"
                                           placeholder="Token Price" value="{{ $tokens[1]['price'] }}">
                                </div>
                            </li>
                        @endif
                        <li>
                            <ul class="options">
                                <li>{{ $tokens[1]['count'] }} tokens</li>
                                <li>&nbsp;</li>
                                <li>&nbsp;</li>
                                <li>S${{ $tokens[1]['price'] }}.00 <span>only!</span></li>
                            </ul>
                        </li>
                        @if(session('user_id') != 1)
                            <li class="button"><a href="/u/p/t?t=1">Purchase</a></li>
                        @else
                            <li class="button"><a class="update-token" id="update-token-1" data-id="1"
                                                  href="#">Update</a></li>
                        @endif
                    </ul>
                </li>

                <li class="plan">
                    <ul class="planContainer">
                        @if(session('user_id') != 1)
                            <li class="title">
                                <h2><p class="bestPlanTitle"></h2>
                            </li>
                            <li class="price"><p class="bestPlanPrice">Lucky Pack {{ $tokens[2]['count'] }}</p></li>
                        @else
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">Tokens</span>
                                    <input id="txt-buy_token-count-2" type="text" class="form-control"
                                           placeholder="Token Count" value="{{ $tokens[2]['count'] }}">
                                </div>
                            </li>
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;S$&nbsp;&nbsp;&nbsp;</span>
                                    <input id="txt-buy_token-price-2" type="text" class="form-control"
                                           placeholder="Token Price" value="{{ $tokens[2]['price'] }}">
                                </div>
                            </li>
                        @endif
                        <li>
                            <ul class="options">
                                <li>{{ $tokens[2]['count'] }} tokens</li>
                                <li>Extra {{ $tokens[2]['extra_tokens'] }} tokens</li>
                                <li style="font-style: italic">({{ $tokens[2]['count'] + $tokens[2]['extra_tokens'] }} tokens)</li>
                                <li>S${{ $tokens[2]['price'] }}.00 <span>only!</span></li>
                            </ul>
                        </li>
                        @if(session('user_id') != 1)
                            <li class="button"><a class="bestPlanButton" href="/u/p/t?t=2">Purchase</a></li>
                        @else
                            <li class="button"><a class="update-token" id="update-token-2" data-id="2"
                                                  href="#">Update</a></li>
                        @endif
                    </ul>
                </li>

                <li class="plan">
                    <ul class="planContainer">
                        @if(session('user_id') != 1)
                            <li class="title"><h2></h2></li>
                            <li class="price"><p>Lucky Pack {{ $tokens[3]['count'] }}</p></li>
                        @else
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">Tokens</span>
                                    <input id="txt-buy_token-count-3" type="text" class="form-control"
                                           placeholder="Token Count" value="{{ $tokens[3]['count'] }}">
                                </div>
                            </li>
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;S$&nbsp;&nbsp;&nbsp;</span>
                                    <input id="txt-buy_token-price-3" type="text" class="form-control"
                                           placeholder="Token Price" value="{{ $tokens[3]['price'] }}">
                                </div>
                            </li>
                        @endif
                        <li>
                            <ul class="options">
                                <li>{{ $tokens[3]['count'] }} tokens</li>
                                <li>Extra {{  $tokens[3]['extra_tokens'] }} tokens</li>
                                <li style="font-style: italic">({{ $tokens[3]['count'] + $tokens[3]['extra_tokens'] }} tokens)</li>
                                <li>S${{ $tokens[3]['price'] }}.00 <span>only!</span></li>
                            </ul>
                        </li>
                        @if(session('user_id') != 1)
                            <li class="button"><a href="/u/p/t?t=3">Purchase</a></li>
                        @else
                            <li class="button"><a class="update-token" id="update-token-3" data-id="3"
                                                  href="#">Update</a></li>
                        @endif
                    </ul>
                </li>

                <li class="plan">
                    <ul class="planContainer">
                        @if(session('user_id') != 1)
                            <li class="title"><h2></h2></li>
                            <li class="price"><p>Lucky Pack {{ $tokens[4]['count'] }}</p></li>
                        @else
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">Tokens</span>
                                    <input id="txt-buy_token-count-4" type="text" class="form-control"
                                           placeholder="Token Count" value="{{ $tokens[4]['count'] }}">
                                </div>
                            </li>
                            <li class="price">
                                <div class="input-group">
                                    <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;S$&nbsp;&nbsp;&nbsp;</span>
                                    <input id="txt-buy_token-price-4" type="text" class="form-control"
                                           placeholder="Token Price" value="{{ $tokens[4]['price'] }}">
                                </div>
                            </li>
                        @endif
                        <li>
                            <ul class="options">
                                <li>{{ $tokens[4]['count'] }} tokens</li>
                                <li>Extra {{ $tokens[4]['extra_tokens'] }} tokens</li>
                                <li style="font-style: italic">({{ $tokens[4]['count'] + $tokens[4]['extra_tokens'] }} tokens)</li>
                                <li>S${{ $tokens[4]['price'] }}.00 <span>only!</span></li>
                            </ul>
                        </li>
                        @if(session('user_id') != 1)
                            <li class="button"><a href="/u/p/t?t=4">Purchase</a></li>
                        @else
                            <li class="button"><a class="update-token" id="update-token-4" data-id="4"
                                                  href="#">Update</a></li>
                        @endif
                    </ul>
                </li>
            </ul> <!-- End ul#plans -->
        </section>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>

    @if(isset($error_message))
        <script>
            swal({
                title: "Tokens Purchase Failed",
                text: "{{ $error_message }}",
                type: "error",
                timer: 30000,
                showConfirmButton: true
            }, function () {
                window.location.href = '/u/p/s';
            });
        </script>
    @endif

    @if(isset($token_count))
        <script>
            swal({
                title: "Tokens Purchased!",
                text: "You successfully purchased {{ $token_count }} tokens!",
                type: "success",
                timer: 30000,
                showConfirmButton: true
            }, function () {
                window.location.href = '/u/p/s';
            });
        </script>
    @endif

    @if(session('user_id') == 1)
        <script>
            $('.token-count').attr('contenteditable', 'true');
            $('.update-token').on('click', function (e) {
                swal({
                            title: 'Update Token Pack',
                            text: 'Are you sure you want to update this token pack?',
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Update Token Pack",
                            showLoaderOnConfirm: true,
                            closeOnConfirm: false
                        },
                        function () {
                            setTimeout(function () {
                                var id = $(e.target).data('id');
                                var count = $('#txt-buy_token-count-' + id).val();
                                var price = $('#txt-buy_token-price-' + id).val();
                                $.post('/u/p/u', {
                                    'i': id,
                                    'c': count,
                                    'p': price
                                }, function (rx) {
                                    swal({
                                        title: xssFilter(rx[1]),
                                        type: xssFilter(rx[2]),
                                        timer: 10000,
                                        showConfirmButton: true
                                    }, function () {
                                        window.location.href = '/u/p/s';
                                    });
                                });
                            }, 3000);
                        });
            });
            $(".form-control").keydown(function (e) {
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
        </script>
    @else
        <script>
            $('.about').attr('contenteditable', 'false');
        </script>
    @endif

@endsection
