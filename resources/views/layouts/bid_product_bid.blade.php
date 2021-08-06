@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="breadcrumbs-bar">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{ $p_url }}">{{ $p_parent }}</a></li>
                <li class="active">Add {{ $p_name }} to Bid</li>
            </ol>
        </div>
        <div class="product">
            <div class="img-product">
                @if(!empty($imgs))
                    @if(isset($imgs[0]))
                        <img src="{{ asset('product-imgs/' . $imgs[0]) }}" class="large" alt=""/>
                    @else
                        <img src="{{ asset('img/no-image.png') }}" class="large" alt=""/>
                    @endif
                @else
                    <img src="{{ asset('img/no-image.png') }}" class="large" alt=""/>
                @endif

                <div class="thumbnails owl-carousel" id="product-thumbnails">
                    @if(!empty($imgs))
                        @foreach($imgs as $i_k => $i)
                            @if(isset($i))
                                @if($i_k == 0)
                                    <a href="#" id="{{ $ids[$i_k] }}" class="item active"
                                       data-image="{{ asset('product-imgs/' . $i) }}">
                                        <img class="lazyOwl" src="{{ asset('product-imgs/' . $i) }}"
                                             data-src="{{ asset('product-imgs/' . $i) }}" alt=""/>
                                    </a>
                                @else
                                    <a href="#" id="{{ $ids[$i_k] }}" class="item"
                                       data-image="{{ asset('product-imgs/' . $i) }}">
                                        <img class="lazyOwl" src="{{ asset('product-imgs/' . $i) }}"
                                             data-src="{{ asset('product-imgs/' . $i) }}" alt=""/>
                                    </a>
                                @endif
                            @endif
                        @endforeach
                    @endif
                </div>

            </div>

            <div class="product-desc">
                <input id="txt-product_details-name" type="text" class="form-control" placeholder="Product Name"
                       value="{{ $p_name }}" readonly="readonly">
                <ul>
                    <li>
                        <label>Auction Start :</label>
                        <input class="bid-date" type="text" id="txt-show_bid-date-start" value="{{ $p_start }}"
                               readonly="readonly">
                    </li>
                    <li>
                        <label>Auction End :</label>
                        <input class="bid-date" type="text" id="txt-show_bid-date-end" value="{{ $p_end }}"
                               readonly="readonly">
                    </li>
                    <li>
                        <label>Increment :</label>
                        <div class="input-group">
                            <span class="input-group-addon">S$</span>
                            <input id="txt-show_bid-increment" type="text" class="form-control"
                                   placeholder="Increment By" value="{{ $d_increment }}">
                        </div>
                    </li>
                    <li>
                        @if($action == 'add')
                            <button type="button" id="btn-show_bid-add" class="btn" data-id="{{ $d_id }}"
                                    data-product="{{ $p_id }}">Add
                            </button>
                        @else
                            <button type="button" id="btn-show_bid-update" class="btn" data-id="{{ $d_id }}"
                                    data-product="{{ $p_id }}">Update
                            </button>
                            <button type="button" id="btn-show_bid-delete" class="btn" data-id="{{ $d_id }}"
                                    data-product="{{ $p_id }}">Delete
                            </button>
                        @endif
                        <a href="{{ $p_url }}" type="button" class="btn">Cancel</a>
                    </li>
                </ul>
            </div>
        </div>
    </div> <!-- <div class="container"> -->

    <script>

        $('#txt-show_bid-date-start').appendDtpicker({
            inline: true,
            firstDayOfWeek: 1,
            calendarMouseScroll: false,
            futureOnly: true
        });
        $('#txt-show_bid-date-end').appendDtpicker({
            inline: true,
            firstDayOfWeek: 1,
            calendarMouseScroll: false,
            futureOnly: true
        });

        $('#txt-show_bid-date-start').handleDtpicker('setDate', new Date('{{ $p_start }}'));
        $('#txt-show_bid-date-end').handleDtpicker('setDate', new Date('{{ $p_end }}'));

        @if($action == 'add')
          $("#btn-show_bid-add").on('click', function () {
        @else
          $("#btn-show_bid-update").on('click', function () {
        @endif
                var s = $('#txt-show_bid-date-start').val();
                var e = $('#txt-show_bid-date-end').val();
                var b = $(this).data('id');
                var p = $(this).data('product');
                var i = $('#txt-show_bid-increment').val();
                $.post('/b/m/sd', {
                    'a': '{{ $action }}',
                    'b': b,
                    'p': p,
                    's': s,
                    'i': i,
                    'e': e
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
                            timer: 10000,
                            showConfirmButton: true
                        }, function () {
                            window.location.href = xssFilter(rx[2]);
                        });
                    }
                });
            });

            @if($action != 'add')
              $("#btn-show_bid-delete").on('click', function () {
                var b = $(this).data('id');
                swal({
                            title: 'Delete this Auction?',
                            text: 'Tokens will be credited back to the participants after deletion',
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Delete",
                            showLoaderOnConfirm: true,
                            closeOnConfirm: false
                        },
                        function () {
                            setTimeout(function () {
                                $.post('/b/m/dd', {
                                    'b': xssFilter(b)
                                }, function (rx) {
                                    swal({
                                        title: 'Delete Success',
                                        text: rx[1],
                                        type: 'success',
                                        timer: 30000,
                                        showConfirmButton: true
                                    }, function () {
                                        window.location.href = xssFilter(rx[2]);
                                    });
                                });
                            }, 3000);
                        });
            });
            @endif

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
                if ($(this).val().length > 3) {
                    e.preventDefault();
                }
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }

            });

    </script>

    <script>
        ZoomElevate();
        ZoomOwlCarousel();
    </script>


@endsection
