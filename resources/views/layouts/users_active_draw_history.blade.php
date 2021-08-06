@extends('layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row" style="margin-top: 50px;">
            <div class="login-pane" style="padding: 10px;">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="/r">User Payments</a></li>
                    <li role="presentation" class="active"><a href="#">Active Lucky Draws</a></li>
                    <li role="presentation"><a href="/r/d">Lucky Draws</a></li>
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
                        <a href="/r/e/ald">
                            <button id="btn-export-to-excel" class="btn btn-danger btn-sm pull-right" type="button"
                                    style="margin-bottom:15px;">Export To Excel
                            </button>
                        </a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Lucky Draw End Date
                                </th>
                                <th>
                                    Draw ID
                                </th>
                                <th>
                                    Participants
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
                                            {{ $draw['draw_end_date'] }}
                                        </td>
                                        <td>
                                            {{ 'D' . str_pad($draw['draw_id'], 6, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td>
                                            @if(!empty($draw['participants']))
                                                <select class="draw-selected-winner" data-id="{{ $draw['draw_id'] }}"
                                                        style="width:100%">
                                                    <option value="0"> - Auto Select -</option>
                                                    @foreach($draw['participants'] as $participant)
                                                        <option value="{{ $participant['user_id'] }}">{{ $participant['user_nick_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                No Participants
                                            @endif
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
                    <h2 class="title-header">Total: {{ $draws['draw_plans_total'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.draw-selected-winner').on('change', function (e) {
            var id = $(e.target).data('id');
            $.post('/r/ad/u', {
                'd': xssFilter(id),
                'u': xssFilter($(e.target).val())
            }, function (rx) {
                if (rx[0]) {
                    swal({
                        title: xssFilter(rx[1]),
                        timer: 10000,
                        showConfirmButton: true
                    });
                }
            });
        });
    </script>

@endsection
