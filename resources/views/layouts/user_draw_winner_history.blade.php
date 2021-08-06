@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px;">
            <div class="login-pane" style="padding: 10px;">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#">Lucky
                            Draws{!! Auth::user()->draw_pending_payment() !!}</a></li>
                    <li role="presentation"><a href="/u/b/w">Auctions{!! Auth::user()->bid_pending_payment() !!}</a>
                    </li>
                    <li role="presentation"><a href="/u/r/p/p/d">Lucky Draw
                            Purchases{!! Auth::user()->draw_purchase_pending_payment() !!}</a></li>
                    <li role="presentation"><a href="/u/r/p/p/b">Auction
                            Purchases{!! Auth::user()->bid_purchase_pending_payment() !!}</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="login-pane" style="min-height: 500px;">
                    <h1 class="title-header">Lucky Draw Cart</h1>
                    <div class="report-container">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Draw Date
                                </th>
                                <th>
                                    Draw ID
                                </th>
                                <th>
                                    Item Name
                                </th>
                                <th>
                                    Remarks
                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($draws['draws']))
                                @foreach($draws['draws'] as $draw)
                                    <tr>
                                        <td>
                                            {{ $draw['created_at'] }}
                                        </td>
                                        <td>
                                            <a href="/p/d/s?p={{ $draw['product_id'] }}&m=udw&d={{ $draw['draw_id'] }}">
                                                {{ 'D' . str_pad($draw['draw_id'], 6, '0', STR_PAD_LEFT) }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $draw['item_name'] }}
                                        </td>
                                        <td>
                                            @if($draw['item_status'] == 2)
                                                <a href="/u/p/d?d={{ $draw['draw_id'] }}"
                                                   class="btn btn-primary btn-sm report-action btn-action"
                                                   type="button">Pay Delivery</a>
                                            @elseif($draw['item_status'] == 3)
                                                <button class="btn btn-primary btn-sm report-action" type="button"
                                                        data-id="{{ $draw['draw_id'] }}">Paid
                                                </button>
                                            @elseif($draw['item_status'] == 4)
                                                <button class="btn btn-primary btn-sm report-action" type="button"
                                                        data-id="{{ $draw['draw_id'] }}">Delivered
                                                </button>
                                            @else
                                                No Remarks
                                            @endif
                                        </td>
                                        <td class="report-table">
                                            <img class="product-report-thumbnail"
                                                 src="{{ asset($draw['item_image']) }}"/>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="pagination"> {{ $draws['users_draw_history'] }} </div>
                    <br>
                    <h2 class="title-header">Total: {{ $draws['users_draw_total'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.report-action').on('click', function (e) {
            var id = $(e.target).data('id');

            $.post('/r/d/w/a', {
                'a': xssFilter(id)
            }, function (rx) {
                if (!rx[0]) {
                    swal({
                        title: xssFilter(rx[1]),
                        timer: 10000,
                        showConfirmButton: true
                    });
                }
                else {
                    var $textAndPic = $('<div></div>');
                    $textAndPic.append(rx[2]);

                    BootstrapDialog.show({
                        title: rx[1],
                        message: $textAndPic,
                        buttons: [{
                            label: 'Cancel',
                            action: function (dialogRef) {
                                dialogRef.close();
                            }
                        }]
                    });
                }
            });
        });
    </script>

    @if(isset($message))
        <script>
            swal({
                title: "{{ $message[0] }}",
                text: "{{ $message[1] }}",
                type: "{{ $message[2] }}",
                timer: 30000,
                showConfirmButton: true
            }, function () {
                window.location.href = '/u/d/w';
            });
        </script>
    @endif

@endsection
