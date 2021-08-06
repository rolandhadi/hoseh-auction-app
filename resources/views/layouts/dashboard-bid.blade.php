@extends('layouts.master')

@section('content')

    @include('templates.jumbotron')

    <div class="container">
        <div class="section">
            <div class="row" style="margin-top:-10px;">
                <div class="col-sm-6 text-center">
                    <a href="/#main" class="btn btn-nav-draw btn-lg btn3d">LUCKY DRAWS</a>
                </div>
                <div class="col-sm-6 text-center">
                    <a href="#main" class="btn btn-nav-bid btn-lg btn3d">AUCTIONS</a>
                </div>
            </div>
            <div class="section">
                <h2 id="main">Active Auctions</h2>
                <div id="div-dashboard-active-bid" class="row list-thumbnail inequitable">
                    @if(!empty($active_bids))
                        @foreach($active_bids as $d_k => $d)
                            @if(isset($d))
                                @include('templates.active_bid_product_kenji', array(
                                  'id' => $d['id'],
                                  'product' => $d['product'],
                                  'img' => asset($d['img']),
                                  'bid_amount' => 'S$ ' . $d['bid_amount'],
                                  'last_bidder' => $d['last_bidder'],
                                  'thumbsize' => asset($d['thumbsize']),
                                  'name' => $d['name']
                                  ))
                            @endif
                        @endforeach
                    @else
                        @include('templates.manage_product', array(
                          'id' => '#',
                          'product' => 0,
                          'img' => asset('img/no-image.png'),
                          'bid_amount' => 'S$ 0.00',
                          'last_bidder' => '',
                          'name' => 'No Product Found'
                          ))
                    @endif
                </div> <!-- <div id="div-dashboard-completed-bid""> -->
            </div> <!-- <div class="container"> -->
        </div> <!-- <div class="section"> -->
        <div class="section" style="padding-bottom: 15px;">
            <h2>Completed Auctions</h2>
            <div id="div-dashboard-completed-bid">
                <div class="list-thumbnail list-slide">
                    @if(!empty($completed_bids))
                        @foreach($completed_bids as $d_k => $d)
                            @if(isset($d))
                                @include('templates.completed_bid_product_kenji', array(
                                  'id' => $d['id'],
                                  'product' => $d['product'],
                                  'img' => asset($d['img']),
                                  'name' => $d['name'],
                                  'bid_amount' => 'S$ ' . $d['bid_amount'],
                                  'savings' => $d['savings'],
                                  'price' => $d['price'],
                                  'winner' => $d['winner']
                                  ))
                            @endif
                        @endforeach
                    @else
                        @include('templates.completed_bid_product_kenji', array(
                          'id' => '#',
                          'product' => 0,
                          'img' => asset('img/no-image.png'),
                          'name' => 'No Product Found',
                          'bid_amount' => 'S$ 0.00',
                          'winner' => ''
                          ))
                    @endif
                </div> <!-- <div class="list-thumbnail list-slide"> -->
            </div> <!-- <div id="div-dashboard-completed-bid""> -->
        </div> <!-- <div class="container"> -->
        <div class="section">
          @if(!empty($testimonials))
              <h2>Testimonials</h2>
              @include('templates.testimonials', array('testimonials' => $testimonials['testimonials'] ))
          @endif
        </div>
    </div> <!-- <div class="container"> -->

    <script>
        setInterval(function () {
            hoseh_update_bids();
        }, 1000);

        $('.btn-bid_management_join').on('click', function (e) {
            hoseh_join_bid(e);
        });
    </script>

@endsection
