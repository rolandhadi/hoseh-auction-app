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
                @if(!empty($imgs))
                    @if(isset($imgs[0]))
                        <img src="{{ asset('product-imgs/' . $imgs[0]) }}" class="large" alt=""/>
                    @else
                        <img src="{{ asset('img/no-image.png') }}" class="large" alt=""/>
                    @endif
                @else
                    <img src="{{ asset('img/no-image.png') }}" class="large" alt=""/>
                @endif

                <div class="thumbnails owl-carousel" id="product-thumbnails" style="padding-bottom: 5px;">
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
                <ul>
                    @if(isset($p_details))
                        @if($p_details['type'] == 'draw')
                            <li><label>Draw ID: </label> {{ $p_details['draw_id'] }}</li>
                            <li><label>Item: </label> {{ $p_name }}</li>
                            <li><label>Description: </label> {!! $p_desc !!}</li>
                            <li><label>Price: </label> S$ {{ $p_price }}</li>
                            @if($p_details['status'] != 1)
                                <li><label>Status: </label> Completed</li>
                                <li><label>Winner: </label> {{  $p_details['winner_name']  }} </li>
                            @else
                                <li><label>Updated: </label>
                                    <div id="draw-last-update" class="bid-time active-draw"
                                         data-updated="{{ $p_details['updated_at'] }}"
                                         style="display:inline-block"> {{ $p_details['updated_at'] }} </div>
                                </li>
                                <li><label> </label>
                                    <div id="draw-time-{{ $p_details['id'] }}" class="bid-time active-draw"
                                         data-id="{{ $p_details['id'] }}" style="display:inline-block"></div>
                                </li>
                                @if(session('user_id') != 1)
                                    <li class="hide-on-processing">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Action: </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <a id="btn-draw_management_join-{{ $p_details['id'] }}"
                                                   class="pull-right btn btn-primary btn-bid btn-draw_management_join"
                                                   data-id="{{ $p_details['id'] }}">Join</a>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="hide-on-processing">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Action: </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="/d/m/d?a=2&d={{ $p_details['id'] }}&p={{ $p_id }}&m=d"
                                                   id="btn-draw_management_edit-{{ $p_details['id'] }}"
                                                   class="pull-right btn btn-primary btn-bid btn-draw_management_edit">Edit</a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endif
                            @if(session('user_id') !== null)
                                @if(session('user_id') != $p_details['winner_id'] && session('user_id') != 1 && !$p_details['bought'])
                                    <li class="hide-on-processing">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Purchase: </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="/u/p/p?t=draw&p={{ $p_id }}&d={{ $p_details['id'] }}"
                                                   id="btn-draw_management_buy-{{ $p_details['id'] }}"
                                                   class="pull-right btn btn-primary btn-bid btn-buy-detail btn-draw_management_buy"
                                                   data-id="{{ $p_details['id'] }}">Buy</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="pull-right"><b>({{ $p_details['return_token'] }}) token(s) will
                                                    be returned to you</b></div>
                                        </div>
                                    </li>
                                @endif
                            @else
                                <li class="hide-on-processing">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Purchase: </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="/d/m/d?a=2&d={{ $p_details['id'] }}&p={{ $p_id }}&m=d"
                                               id="btn-draw_management_buy-{{ $p_details['id'] }}"
                                               class="pull-right btn btn-primary btn-bid btn-buy-detail btn-draw_management_buy"
                                               data-id="{{ $p_details['id'] }}">Buy</a></div>
                                    </div>
                                    <div class="row">
                                        <div class="pull-right"><b>({{ 0 }}) token(s) will be returned to you</b></div>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <table id="draw-entries" class="table-striped table-entries">
                                    <thead>
                                      <tr>
                                          <th style="width: 100%; text-align: center" >TOTAL {{ $p_details['total_participants'] }} ENTRIES </th>
                                      </tr>
                                      <tr>
                                          <th style="width: 100%">Entries</th>
                                          <th style="width: 100%">#</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($p_details['participants']))
                                        @foreach($p_details['participants'] as $k => $participant)
                                            <tr>
                                                <td class="table-participants">{{ $participant['user'] }}</td>
                                                <td class="table-participants">{{ $p_details['total_participants'] - $k }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="table-participants">-</td>
                                            <td class="table-participants">-</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </li>
                        @elseif($p_details['type'] == 'bid')
                            <li><label>Auction ID: </label> {{ $p_details['bid_id'] }}</li>
                            <li><label>Item: </label> {{ $p_name }}</li>
                            <li><label>Description: </label> {!! $p_desc !!}</li>
                            <li><label>Price: </label> S$ {{ $p_price }}</li>
                            <li><label>Increment: </label> S$ {{ $p_details['bid_increment'] }}</li>
                            @if($p_details['status'] != 1)
                                <li><label>Status: </label> Completed</li>
                                <li><label>Winner: </label> {{  $p_details['winner_name']  }} </li>
                                <li><label>Bid Price: </label> S$ {{  $p_details['bid_price']  }} </li>
                                <li><label>Savings: </label> {{  $p_details['savings']  }} </li>
                            @else
                                <li><label>Updated: </label>
                                    <div id="bid-last-update" class="bid-time active-bid"
                                         data-updated="{{ $p_details['updated_at'] }}"
                                         style="display:inline-block"> {{ $p_details['updated_at'] }} </div>
                                </li>
                                <li><label> </label>
                                    <div id="bid-time-{{ $p_details['id'] }}" class="bid-time active-bid"
                                         data-id="{{ $p_details['id'] }}" style="display:inline-block"></div>
                                </li>
                                @if(session('user_id') != 1)
                                    <li class="hide-on-processing">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Action: </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <a id="btn-bid_management_join-{{ $p_details['id'] }}"
                                                   class="pull-right btn btn-primary btn-bid btn-bid_management_join"
                                                   data-id="{{ $p_details['id'] }}">Bid</a></div>
                                        </div>
                                    </li>
                                @else
                                    <li class="hide-on-processing">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Action: </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="/b/m/d?a=2&b={{ $p_details['id'] }}&p={{ $p_id }}&m=b"
                                                   id="btn-bid_management_edit-{{ $p_details['id'] }}"
                                                   class="pull-right btn btn-primary btn-bid btn-bid_management_edit">Edit</a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endif
                            @if(session('user_id') !== null)
                                @if(session('user_id') != $p_details['winner_id'] && session('user_id') != 1 && !$p_details['bought'])
                                    <li class="hide-on-processing">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Purchase: </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="/u/p/p?t=bid&p={{ $p_id }}&b={{ $p_details['id'] }}"
                                                   id="btn-bid_management_buy-{{ $p_details['id'] }}"
                                                   class="pull-right btn btn-primary btn-bid btn-buy-detail btn-bid_management_buy"
                                                   data-id="{{ $p_details['id'] }}">Buy</a></div>
                                        </div>
                                        <div class="row">
                                            <div class="pull-right"><b>({{ $p_details['return_token'] }}) token(s) will
                                                    be returned to you</b></div>
                                        </div>
                                    </li>
                                @endif
                            @else
                                <li class="hide-on-processing">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Purchase: </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="/b/m/d?a=2&b={{ $p_details['id'] }}&p={{ $p_id }}&m=b"
                                               id="btn-bid_management_buy-{{ $p_details['id'] }}"
                                               class="pull-right btn btn-primary btn-bid btn-buy-detail btn-bid_management_buy"
                                               data-id="{{ $p_details['id'] }}">Buy</a>
                                        </div>
                                        <div class="row">
                                            <div class="pull-right"><b>({{ 0 }}) token(s) will be returned to you</b>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <table id="bid-entries" class="table-striped table-entries">
                                    <thead>
                                      <tr>
                                          <th style="width: 100%; text-align: center" >TOTAL {{ $p_details['total_bids'] }} BIDS </th>
                                      </tr>
                                      <tr>
                                          <th style="width: 100%">Bids</th>
                                          <th style="width: 100%">Amount</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($p_details['participants']))
                                        @foreach($p_details['participants'] as $k => $participant)
                                            <tr>
                                                <td class="table-participants">{{ $participant['user'] }}</td>
                                                <td class="table-participants">{{ $participant['bid'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="table-participants">-</td>
                                            <td class="table-participants">-</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </li>
                        @endif
                    @else
                        <li><label>Item: </label> {{ $p_name }}</li>
                        <li><label>Description: </label> {!! $p_desc !!}</li>
                        <li><label>Price: </label> S$ {{ $p_price }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div> <!-- <div class="container"> -->

    @if(!empty($tags))
        @foreach($tags as $t)
            @if(isset($t))
                <script>
                    $('#txt-product_details-tags').tagsinput('add', '{{ $t->tag }}');
                    $('#txt-product_details-tags').data('{{ $t->tag }}', '{{ $t->id }}');
                </script>
            @endif
        @endforeach
    @endif

    <script>
        ZoomElevate();
        ZoomOwlCarousel();
    </script>

    @if(isset($p_details))
        @if($p_details['type'] == 'draw')
            @if($p_details['status'] == 1)
                <script>
                    setInterval(function () {
                        hoseh_update_draws();
                        hoseh_show_draw_participants();
                        hoseh_draw_ended();
                    }, 1000);
                    $('.btn-draw_management_join').on('click', function (e) {
                        hoseh_join_draw(e);
                    });
                    function hoseh_show_draw_participants() {
                        var last_update = $('#draw-last-update').data('updated');
                        $.post('/d/s/p', {
                            'd': '{{ $p_details['id'] }}',
                            'u': last_update
                        }, function (rx) {
                            if (rx[0]) {
                                $('#draw-last-update').data('updated', rx[1]);
                                $('#draw-last-update').text(rx[1]);
                                $("#draw-entries").find("tr:gt(0)").remove();
                                rx[2].forEach(function (entry, i) {
                                    $('#draw-entries tr').last().after('<tr><td class="table-participants">' + (i + 1) + '</td><td class="table-participants">' + entry + '</td></tr>');
                                });
                            }
                        });
                    }
                    function hoseh_draw_ended() {
                        if ($('#draw-time-' + '{{ $p_details['id'] }}').text() == 'Completed')
                            window.location.reload(true);
                    }
                </script>
            @endif
        @elseif($p_details['type'] == 'bid')
            @if($p_details['status'] == 1)
                <script>
                    setInterval(function () {
                        hoseh_update_bids();
                        hoseh_show_bid_participants();
                        hoseh_bid_ended();
                    }, 1000);
                    $('.btn-bid_management_join').on('click', function (e) {
                        hoseh_join_bid(e);
                    });
                    function hoseh_show_bid_participants() {
                        var last_update = $('#bid-last-update').data('updated');
                        $.post('/b/s/p', {
                            'b': '{{ $p_details['id'] }}',
                            'u': last_update
                        }, function (rx) {
                            if (rx[0]) {
                                $('#bid-last-update').data('updated', rx[1]);
                                $('#bid-last-update').text(rx[1]);
                                $("#bid-entries").find("tr:gt(0)").remove();
                                rx[2].forEach(function (entry, i) {
                                    $('#bid-entries tr').last().after('<tr><td class="table-participants">' + (i + 1) + '</td><td class="table-participants">' + entry + '</td></tr>');
                                });
                            }
                        });
                    }
                    function hoseh_bid_ended() {
                        if ($('#bid-time-' + '{{ $p_details['id'] }}').text() == 'Completed')
                            window.location.reload(true);
                    }
                </script>
            @endif
        @endif
    @endif

    @if(isset($message))
        <script>
            swal({
                title: "{{ $message[0] }}",
                text: "{{ $message[1] }}",
                type: "{{ $message[2] }}",
                timer: 30000,
                showConfirmButton: true
            }, function () {
                var url = window.location.href.replace('success=true', '').replace('success=false', '')
                window.location.href = url;
            });
        </script>
    @endif

@endsection
