@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="breadcrumbs-bar">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{ $p_url }}">{{ $p_parent }}</a></li>
                <li class="active">{{ $p_name }}</li>
            </ol>
        </div>
        <div class="product">
            <div class="img-product">
                <form data-ajax="false" id="frm-product_details-img" action="/p/d/ai?p={{ $p_id }}" method="POST"
                      enctype="multipart/form-data" name="form">
                    {{ csrf_field() }}
                    <input id="txt-product_details-id" class="hide" name="p" value="/p/d/s?p=|{{ $p_id }}|{{ $p_m }}"
                           data-id="{{ $p_id }}">
                    <input id="txt-product_details-img-path" type="file" class="hide" name="image"
                           onChange="product_details_img_path_change();" accept="image/jpeg,image/x-png"/>
                    <button type="button" id="btn-product_details-add-image" class="product-button-add"
                            onclick="product_details_img_path_click();">
                        <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                    </button>
                </form>
                <button id="btn-product_details-remove-image" class="product-button-remove">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>

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
                       value="{{ $p_name }}" maxlength="20">
                <ul>
                    <li><textarea id="txt-product_details-desc" class="form-control" rows="3"
                                  placeholder="Product Description" required>{{ $p_desc }}</textarea></li>
                <!-- <li>
            <label>Qty :</label>
            <div class="quantity">
                <div class="minus">
                  <a class="ddd" href="#">-</a>
                </div>
                <div class="input">
                    <input id="txt-product_details-qty" type="text" class="quntity-input" value="{{ $p_quantity }}" />
                </div>
                  <div class="plus"> <a class="ddd" href="#">+</a>
                </div>
            </div>
          </li> -->
                    <li>
                        <label>Price :</label>
                        <div class="input-group">
                            <span class="input-group-addon">S$</span>
                            <input id="txt-product_details-price" type="text" class="form-control" placeholder="Price"
                                   value="{{ ($p_price > 0 ? $p_price : 1) }}"/>
                        </div>
                    </li>
                    <li>
                        <label>Dlvry Chg:</label>
                        <div class="input-group">
                            <span class="input-group-addon">S$</span>
                            <input id="txt-product_details-delivery-charge" type="text" class="form-control"
                                   placeholder="Delivery Charge" value="{{ ($p_delivery_charge > 0 ? $p_delivery_charge : 1) }}"/>
                        </div>
                    </li>
                    <li>
                        <button type="button" id="btn-product_details-update" class="btn">Update</button>
                        <button type="button" id="btn-product_details-delete" class="btn">Delete</button>
                    </li>
                </ul>
                <ul>
                    <li>
                        <label>Tags :</label>
                        <div class="input-group">
                            <input id="txt-product_details-tags" type="text" class="form-control" placeholder="Tags"
                                   data-role="tagsinput"/>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div> <!-- <div class="container"> -->

    <script>

        function product_details_img_path_click() {
            var img_path = document.getElementById("txt-product_details-img-path");
            img_path.click();
        }

        function product_details_img_path_change() {
            if ($("txt-product_details-img-path").val() != '')
                var img_path = document.getElementById("txt-product_details-img-path");
        }

        $('#btn-product_details-remove-image').on('click', function () {
            bootbox.confirm("Are you sure you want to remove this image?", function (rx) {
                if (rx) {
                    $.post('/p/d/di', {
                        'i': $('.item.active').attr('id'),
                        'p': $('#txt-product_details-id').val()
                    }, function (rx) {
                        if (rx[0]) {
                            swal({
                                title: xssFilter(rx[1]),
                                timer: 10000,
                                showConfirmButton: true
                            }, function () {
                                window.location.replace(xssFilter(rx[2]));
                            });
                        }
                    });
                }
            });
        });

        $('#txt-product_details-tags').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44],
            maxChars: 50
        });

        $('#txt-product_details-tags').on('beforeItemAdd', function (e) {
            $.post('/p/m/at', {
                'p': $("#txt-product_details-id").data('id'),
                't': e.item
            }, function (rx) {
                if (rx) {
                    $('#txt-product_details-tags').data(e.item, rx.id)
                }
                else {
                    $('#txt-product_details-tags').tagsinput('remove', e.item);
                }
            });
        });

        $('#txt-product_details-tags').on('beforeItemRemove', function (e) {
            $.post('/p/m/dt', {
                'p': $("#txt-product_details-id").data('id'),
                't': $('#txt-product_details-tags').data(e.item)
            });
        });

        $("#txt-product_details-img-path").change(function () {
            $("#frm-product_details-img").submit();
        });

        $("#btn-product_details-update").on('click', function () {
            $.post('/p/m/up', {
                'p': $("#txt-product_details-id").data('id'),
                'n': $("#txt-product_details-name").val(),
                'd': $("#txt-product_details-desc").val(),
                'q': 999,
                'pr': $("#txt-product_details-price").val(),
                'dc': $("#txt-product_details-delivery-charge").val(),
                't': $("#txt-product_details-tags").val()
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


        $("#btn-product_details-delete").on('click', function () {
            bootbox.confirm("Are you sure you want to remove this product?", function (rx) {
                if (rx) {
                    $.post('/p/m/dp', {
                        'p': $("#txt-product_details-id").data('id')
                    }, function (rx) {
                        if (!rx[0]) {
                            swal({
                                title: xssFilter(rx[1]),
                                timer: 10000,
                                showConfirmButton: true
                            });
                        }
                        else {
                            window.location.href = '/p/m';
                        }
                    });
                }
            });
        });

    </script>

    @if(!empty($tags))
        @foreach($tags as $t)
            @if(isset($t))
                <script>
                    $('#txt-product_details-tags').tagsinput('add', '{{ $t->tag }}');
                    $('#txt-product_details-tags').data('{{ $t->tag }}','{{ $t->id }}');
                </script>
            @endif
        @endforeach
    @endif

    <script>
        ZoomElevate();
        ZoomOwlCarousel();
    </script>


@endsection
