@extends('layouts.master')

@section('content')

    <div class="container">

        <!-- Modal -->
        {{ csrf_field() }}

        <div class="section">
            <br>
            <h2>Product Management</h2>

            <div class="input-group input-group-lg">
                <input id="txt-product_management-product" type="text" class="form-control" aria-label="..."
                       maxlength="20" placeholder="Search Product Name">
                <div class="input-group-btn">
                    <button id="btn-product_management-add" type="button" class="btn btn-default" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus"></span>
                        Add New
                    </button>
                </div><!-- /btn-group -->
            </div><!-- /input-group -->
            <div id="div-product_management-products" class="row list-thumbnail inequitable">
                @if(!empty($products))
                    @foreach($products as $p_k => $p)
                        @if(isset($p))
                            @include('templates.manage_product', array(
                              'id' => $p['id'],
                              'img' => asset($p['img']),
                              'quantity' => $p['quantity'],
                              'name' => $p['name']
                              ))
                        @endif
                    @endforeach
                @else
                    @include('templates.manage_product', array(
                      'id' => '#',
                      'img' => asset('img/no-image.png'),
                      'quantity' => '',
                      'name' => 'No Product Found'
                      ))
                @endif
            </div>
            <h2></h2>
            <div class="pagination"> {{ $links }} </div>
        </div> <!-- <div class="section"> -->
    </div> <!-- <div class="container"> -->

    <script>

        $('#txt-product_management-product').on('keyup', function () {
            $.post('/p/m/sp', {
                'p': $("#txt-product_management-product").val()
            }, function (rx) {
                $('#div-product_management-products').html(rx);
            });
        });

        $('#btn-product_management-add').on('click', function () {
            var new_product = $("#txt-product_management-product").val();
            if (new_product) {
                swal({
                            title: 'Add New Product',
                            text: 'Are you sure you want to add ' + new_product + ' ?',
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Add Product",
                            showLoaderOnConfirm: true,
                            closeOnConfirm: false
                        },
                        function () {
                            setTimeout(function () {
                                $.post('/p/m/ap', {
                                    'p': new_product
                                }, function (rx) {
                                    if (!rx[0]) {
                                        swal({
                                            title: xssFilter(rx[1]),
                                            timer: 10000,
                                            showConfirmButton: true
                                        });
                                    }
                                    else {
                                        window.location.href = xssFilter(rx[2]);
                                    }
                                });
                            }, 3000);
                        });
            }
        });
    </script>


@endsection
