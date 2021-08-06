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
                    <li role="presentation" class="active"><a href="#">Auctions</a></li>
                    <li role="presentation"><a href="/r/d/w">Lucky Draw Winners{!! $bids['draw_delivery'] !!}</a></li>
                    <li role="presentation"><a href="/r/b/w">Auction Winners{!! $bids['bid_delivery'] !!}</a></li>
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
                    <h1 class="title-header">Users Auction History</h1>
                    <div class="report-container">
                        <a href="/r/e/a">
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
                                    Auction Entry No.
                                </th>
                                <th>
                                    Item Name
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
                                            {{ $bid['bid_id'] }}
                                        </td>
                                        <td>
                                            {{ $bid['item_name'] }}
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
@endsection
