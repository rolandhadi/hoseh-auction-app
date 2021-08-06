@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px;">
            <div class="login-pane" style="padding: 10px;">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="/r">User Payments</a></li>
                    <li role="presentation"><a href="/r/ad">Active Lucky Draws</a></li>
                    <li role="presentation"><a href="/r/d">Lucky Draws</a></li>
                    <li role="presentation"><a href="/r/b">Auctions</a></li>
                    <li role="presentation"><a href="/r/d/w">Lucky Draw Winners{!! $bids['draw_delivery'] !!}</a></li>
                    <li role="presentation" class="active"><a href="#">Auction Winners{!! $bids['bid_delivery'] !!}</a>
                    </li>
                    <li role="presentation"><a href="/r/p/p/d">Lucky Draw
                            Purchases{!! $bids['draw_purchase_delivery'] !!}</a></li>
                    <li role="presentation"><a href="/r/p/p/b">Auction
                            Purchases{!! $bids['bid_purchase_delivery'] !!}</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="login-pane" style="min-height: 500px;">
                    <h1 class="title-header">Auction Winners History</h1>
                    <div class="report-container">
                        <a href="/r/e/aw">
                            <button id="btn-export-to-excel" class="btn btn-danger btn-sm pull-right" type="button"
                                    style="margin-bottom:15px;">Export To Excel
                            </button>
                        </a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Auction ID
                                </th>
                                <th>
                                    Item Name
                                </th>
                                <th>
                                    Last Bid Price
                                </th>
                                <th>
                                    Remarks
                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($bids['bids']))
                                @foreach($bids['bids'] as $bid)
                                    <tr>
                                        <td>
                                            {{ $bid['created_at'] }}
                                        </td>
                                        <td>
                                            <a href="/u/u?u={{ $bid['winner_id'] }}">
                                                {{ $bid['email'] }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/p/d/s?p={{ $bid['product_id'] }}&m=rbw&b={{ $bid['bid_id'] }}">
                                                {{ 'A' . str_pad($bid['bid_id'], 6, '0', STR_PAD_LEFT) }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $bid['item_name'] }}
                                        </td>
                                        <td>
                                            S$ {{ $bid['last_bid_price'] }}
                                        </td>
                                        <td>
                                            @if($bid['item_status'] == 2)
                                                @if($bid['email'] !== '')
                                                    <button class="btn btn-warning btn-sm report-action" type="button"
                                                            data-id="{{ $bid['bid_id'] }}">Not Paid
                                                    </button>
                                                @else
                                                    <button class="btn btn-error btn-sm report-action" type="button">No
                                                        Winner
                                                    </button>
                                                @endif
                                            @elseif($bid['item_status'] == 3)
                                                <button class="btn btn-primary btn-sm report-action btn-action"
                                                        type="button" data-id="{{ $bid['bid_id'] }}">For Delivery
                                                </button>
                                            @elseif($bid['item_status'] == 4)
                                                <button class="btn btn-primary btn-sm report-action" type="button"
                                                        data-id="{{ $bid['bid_id'] }}">Delivered
                                                </button>
                                            @else
                                                No Remarks
                                            @endif
                                        </td>
                                        <td class="report-table">
                                            <img class="product-report-thumbnail"
                                                 src="{{ asset($bid['item_image']) }}"/>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="pagination"> {{ $bids['users_bid_history'] }} </div>
                    <br>
                    <h2 class="title-header">Total: {{ $bids['users_bid_total'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.report-action').on('click', function (e) {
            var id = $(e.target).data('id');

            $.post('/r/b/w/a', {
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
                            label: 'Deliver',
                            action: function () {
                                swal({
                                            title: 'Mark as Delivered?',
                                            text: 'Are you sure you want to mark as delivered this item?',
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "Deliver",
                                            showLoaderOnConfirm: true,
                                            closeOnConfirm: false
                                        },
                                        function () {
                                            setTimeout(function () {
                                                $.post('/r/b/w/a/d', {
                                                    'a': xssFilter(id)
                                                }, function (rx) {
                                                    swal({
                                                        title: rx[1],
                                                        text: rx[2],
                                                        type: rx[3],
                                                        timer: 30000,
                                                        showConfirmButton: true
                                                    }, function () {
                                                        window.location.href = '/r/b/w';
                                                    });
                                                });
                                            }, 3000);
                                        });
                            }
                        }, {
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
@endsection
