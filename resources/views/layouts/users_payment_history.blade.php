@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px;">
            <div class="login-pane" style="padding: 10px;">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#">User Payments</a></li>
                    <li role="presentation"><a href="/r/ad">Active Lucky Draws</a></li>
                    <li role="presentation"><a href="/r/d">Lucky Draws</a></li>
                    <li role="presentation"><a href="/r/b">Auctions</a></li>
                    <li role="presentation"><a href="/r/d/w">Lucky Draw Winners{!! $purchases['draw_delivery'] !!}</a>
                    </li>
                    <li role="presentation"><a href="/r/b/w">Auction Winners{!! $purchases['bid_delivery'] !!}</a></li>
                    <li role="presentation"><a href="/r/p/p/d">Lucky Draw
                            Purchases{!! $purchases['draw_purchase_delivery'] !!}</a></li>
                    <li role="presentation"><a href="/r/p/p/b">Auction
                            Purchases{!! $purchases['bid_purchase_delivery'] !!}</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="login-pane" style="min-height: 500px;">
                    <h1 class="title-header">Users Payment History</h1>
                    <div class="report-container">
                        <a href="/r/e/up">
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
                                    Invoice ID
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Description
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($purchases['purchases']))
                                @foreach($purchases['purchases'] as $purchase)
                                    <tr>
                                        <td>
                                            {{ $purchase['created_at'] }}
                                        </td>
                                        <td>
                                            <a href="/u/u?u={{ $purchase['user_id'] }}">
                                                {{ $purchase['email'] }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $purchase['invoice_id'] }}
                                        </td>
                                        <td>
                                            S$ {{ $purchase['amount'] }}
                                        </td>
                                        <td>
                                            {{ $purchase['desc'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="pagination"> {{ $purchases['users_payment_history'] }} </div>
                    <br>
                    <h2 class="title-header">Total: S$ {{ $purchases['users_payment_total'] }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
