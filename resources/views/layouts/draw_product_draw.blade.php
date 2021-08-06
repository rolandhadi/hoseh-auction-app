@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="breadcrumbs-bar">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{ $p_url }}">{{ $p_parent }}</a></li>
                <li class="active">Add {{ $p_name }} to Lucky Draw</li>
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
                        <label>Draw Start :</label>
                        <input class="draw-date" type="text" id="txt-show_draw-date-start" value="{{ $p_start }}"
                               readonly="readonly">
                    </li>
                    <li>
                        <label>Draw End :</label>
                        <input class="draw-date" type="text" id="txt-show_draw-date-end" value="{{ $p_end }}"
                               readonly="readonly">
                    </li>
                    <li>
                        @if($action == 'add')
                            <button type="button" id="btn-show_draw-add" class="btn" data-id="{{ $d_id }}"
                                    data-product="{{ $p_id }}">Add
                            </button>
                        @else
                            <button type="button" id="btn-show_draw-update" class="btn" data-id="{{ $d_id }}"
                                    data-product="{{ $p_id }}">Update
                            </button>
                            <button type="button" id="btn-show_draw-delete" class="btn" data-id="{{ $d_id }}"
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

        $('#txt-show_draw-date-start').appendDtpicker({
            inline: true,
            firstDayOfWeek: 1,
            calendarMouseScroll: false,
            futureOnly: true
        });
        $('#txt-show_draw-date-end').appendDtpicker({
            inline: true,
            firstDayOfWeek: 1,
            calendarMouseScroll: false,
            futureOnly: true
        });

        $('#txt-show_draw-date-start').handleDtpicker('setDate', new Date('{{ $p_start }}'));
        $('#txt-show_draw-date-end').handleDtpicker('setDate', new Date('{{ $p_end }}'));

        @if($action == 'add')
          $("#btn-show_draw-add").on('click', function () {
            @else
              $("#btn-show_draw-update").on('click', function () {
                        @endif
                var s = $('#txt-show_draw-date-start').val();
                var e = $('#txt-show_draw-date-end').val();
                var d = $(this).data('id');
                var p = $(this).data('product');
                $.post('/d/m/sd', {
                    'a': '{{ $action }}',
                    'd': d,
                    'p': p,
                    's': s,
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
              $("#btn-show_draw-delete").on('click', function () {
                var d = $(this).data('id');
                swal({
                            title: 'Delete this Lucky Draw?',
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
                                $.post('/d/m/dd', {
                                    'd': xssFilter(d)
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

    </script>

    <script>
        ZoomElevate();
        ZoomOwlCarousel();
    </script>


@endsection
