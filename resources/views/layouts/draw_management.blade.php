@extends('layouts.master')

@section('content')

    <div class="container">

        <!-- Modal -->
        {{ csrf_field() }}

        <div class="section">
            <br>
            <h2>Lucky Draw Management</h2>
            <br>
            <div class="input-group input-group-lg">
                <input id="txt-draw_management-product" type="text" class="form-control" aria-label="..."
                       value="{{ $search }}" placeholder="Search Product Name">
                <div class="input-group-btn">
                    <button id="btn-draw_management-search" type="button" class="btn btn-default" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-search"></span>
                    </button>
                </div><!-- /btn-group -->
            </div><!-- /input-group -->
            <div class="section">
                <br>
                <h2>All Products</h2>
                <div id="div-draw_management-products">
                    <div class="list-thumbnail list-slide">
                        @if(!empty($products))
                            @foreach($products as $p_k => $p)
                                @if(isset($p))
                                    @include('templates.manage_draw_product', array(
                                      'id' => $p['id'],
                                      'img' => asset($p['img']),
                                      'quantity' => $p['quantity'],
                                      'name' => $p['name']
                                      ))
                                @endif
                            @endforeach
                        @else
                            @include('templates.manage_draw_product', array(
                              'id' => '#',
                              'img' => asset('img/no-image.png'),
                              'quantity' => '',
                              'name' => 'No Product Found'
                              ))
                        @endif
                    </div> <!-- <div class="list-thumbnail list-slide"> -->
                </div> <!-- <div id="div-draw_management-products""> -->
            </div> <!-- <div class="container"> -->
        </div> <!-- <div class="section"> -->

        <div class="section">
            <br>
            <h2>Active Lucky Draws</h2>
            <div id="div-active_draw_management-products" class="row list-thumbnail inequitable">
                @if(!empty($active_draws))
                    @foreach($active_draws as $d_k => $d)
                        @if(isset($d))
                            @include('templates.manage_active_draw_product', array(
                              'id' => $d['id'],
                              'product' => $d['product'],
                              'img' => asset($d['img']),
                              'name' => $d['name']
                              ))
                        @endif
                    @endforeach
                @else
                    @include('templates.manage_product', array(
                      'id' => '#',
                      'product' => 0,
                      'img' => asset('img/no-image.png'),
                      'name' => 'No Product Found'
                      ))
                @endif
            </div> <!-- <div id="div-draw_management-products""> -->
            <br>
            <div class="pagination"> {{ $draw_links }} </div>
            <br>
        </div> <!-- <div class="container"> -->
    </div> <!-- <div class="section"> -->

    <script>

        $('#txt-draw_management-product').on('keypress', function (e) {
            if (e.keyCode == 13) {
                $('#btn-draw_management-search').click();
            }
        });

        $('#btn-draw_management-search').on('click', function () {
            var s = $("#txt-draw_management-product").val();
            if (s) {
                window.location.replace("/d/m?p=" + s);
            }
            else {
                window.location.replace("/d/m");
            }
        });

        $('.btn-draw_management_add').on('click', function (e) {
            var id = $(e.target).data('id');
            $.post('/d/m/sp', {
                'p': id
            }, function (rx) {
                bootbox.dialog({
                            title: 'Add [' + rx.product.name + '] to Active Lucky Draws',
                            message: rx.view,
                            buttons: {
                                success: {
                                    label: "Save",
                                    className: "btn-success",
                                    callback: function () {

                                    }
                                }
                            }
                        }
                );
            });
        });

        setInterval(function () {
            hoseh_update_draws();
        }, 1000);

    </script>


@endsection
