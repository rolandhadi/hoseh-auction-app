@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px;">
            <div class="login-pane" style="padding: 10px;">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="/r">User Payments</a></li>
                    <li role="presentation"><a href="/r/ad">Active Lucky Draws</a></li>
                    <li role="presentation" class="active"><a href="#">Lucky Draws</a></li>
                    <li role="presentation"><a href="/r/b">Auctions</a></li>
                    <li role="presentation"><a href="/r/d/w">Lucky Draw Winners{!! $draws['draw_delivery'] !!}</a></li>
                    <li role="presentation"><a href="/r/b/w">Auction Winners{!! $draws['bid_delivery'] !!}</a></li>
                    <li role="presentation"><a href="/r/p/p/d">Lucky Draw
                            Purchases{!! $draws['draw_purchase_delivery'] !!}</a></li>
                    <li role="presentation"><a href="/r/p/p/b">Auction
                            Purchases{!! $draws['bid_purchase_delivery'] !!}</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="login-pane" style="min-height: 500px;">
                    <h1 class="title-header">Users Lucky Draw History</h1>
                    <div class="report-container">
                        <a href="/r/e/ld">
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
                                    Draw Entry No.
                                </th>
                                <th>
                                    Item Name
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
                                            <a href="/u/u?u={{ $draw['winner_id'] }}">
                                                {{ $draw['email'] }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $draw['draw_id'] }}
                                        </td>
                                        <td>
                                            {{ $draw['item_name'] }}
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
@endsection
