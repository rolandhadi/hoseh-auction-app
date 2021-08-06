@extends('layouts.master')

@section('content')

    @include('templates.jumbotron', $banners)

    <div class="container">
        <div class="section">
            <div class="row" style="margin-top:-10px;">
                <div class="col-sm-6 text-center">
                    <a href="#main" class="btn btn-nav-draw btn-lg btn3d">LUCKY DRAWS</a>
                </div>
                <div class="col-sm-6 text-center">
                    <a href="/b/#main" class="btn btn-nav-bid btn-lg btn3d">AUCTIONS</a>
                </div>
            </div>
            <div class="section">
                <h2 id="main">Active Lucky Draws</h2>
                <div id="div-dashboard-active-draw" class="row list-thumbnail inequitable">
                    @if(!empty($active_draws))
                        @foreach($active_draws as $d_k => $d)
                            @if(isset($d))
                                @include('templates.active_draw_product_kenji', array(
                                  'id' => $d['id'],
                                  'joined' => $d['joined'],
                                  'product' => $d['product'],
                                  'img' => asset($d['img']),
                                  'thumbsize' => asset($d['thumbsize']),
                                  'price' => $d['price'],
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
                </div> <!-- <div id="div-dashboard-completed-draw""> -->
            </div> <!-- <div class="container"> -->
        </div> <!-- <div class="section"> -->
        <div class="section" style="padding-bottom: 15px;">
            <h2>Completed Lucky Draws</h2>
            <div id="div-dashboard-completed-draw">
                <div class="list-thumbnail list-slide">
                    @if(!empty($completed_draws))
                        @foreach($completed_draws as $d_k => $d)
                            @if(isset($d))
                                @include('templates.completed_draw_product_kenji', array(
                                  'id' => $d['id'],
                                  'product' => $d['product'],
                                  'img' => asset($d['img']),
                                  'name' => $d['name'],
                                  'price' => $d['price'],
                                  'winner' => $d['winner']
                                  ))
                            @endif
                        @endforeach
                    @else
                        @include('templates.completed_draw_product_kenji', array(
                          'id' => '#',
                          'product' => 0,
                          'img' => asset('img/no-image.png'),
                          'name' => 'No Product Found',
                          'winner' => ''
                          ))
                    @endif
                </div> <!-- <div class="list-thumbnail list-slide"> -->
            </div> <!-- <div id="div-dashboard-completed-draw""> -->
        </div> <!-- <div class="container"> -->
        <div class="section">
          @if(!empty($testimonials))
              <h2>Testimonials</h2>
              @include('templates.testimonials', array('testimonials' => $testimonials['testimonials'] ))
          @endif
        </div>
    </div> <!-- <div class="container"> -->
    <script>


        if (window.innerWidth <= 900) {
            var number_of_qoutes = 1
        }
        else {
            var number_of_qoutes = 2
        }

        $('.quotes').slick({
            dots: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 6000,
            speed: 800,
            slidesToShow: number_of_qoutes,
            adaptiveHeight: true
        });


        $('.no-fouc').removeClass('no-fouc');

        setInterval(function () {
            hoseh_update_draws();
        }, 1000);

        $('.btn-draw_management_join').on('click', function (e) {
            hoseh_join_draw(e);
        });
    </script>

@endsection
