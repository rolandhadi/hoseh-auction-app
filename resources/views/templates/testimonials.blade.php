
<div class="container">
  <br>
  <div id="testimonial" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <!-- <ol class="carousel-indicators">
      <li data-target="#testimonial" data-slide-to="0" class="active"></li>
      <li data-target="#testimonial" data-slide-to="1"></li>
      <li data-target="#testimonial" data-slide-to="2"></li>
      <li data-target="#testimonial" data-slide-to="3"></li>
      <li data-target="#testimonial" data-slide-to="4"></li>
      <li data-target="#testimonial" data-slide-to="5"></li>
    </ol> -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      @foreach($testimonials as $testimonial)
          @if(isset($testimonial))
            <div class="item {{ $testimonial['active'] }}">
              <img src="{{ $testimonial['image'] }}" alt="">
              <div class="carousel-caption">
                <!-- <h3>{{ $testimonial['name'] }}</h3>
                <p>{{ $testimonial['message'] }}</p> -->
              </div>
            </div>
          @endif
      @endforeach

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#testimonial" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#testimonial" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
