<div class="{{ $thumbsize }}">
    <div class="thumbnail">
        <div class="row">
            <div id="draw-time-{{ $id }}" class="bid-time-kenji active-draw" data-id="{{ $id }}"></div>
        </div>
        <div class="row">
        @if($product !== '#')
            <a href="/p/d/s?p={{ $product }}&m=h&d={{ $id }}">
                <img src="{{ asset($img) }}" alt=""/>
            </a>
        @else
            <img src="{{ asset($img) }}" alt=""/>
        @endif
      </div>
      <div class="row">
        <div class="active-item-name"> {{ $name }} </div>
      </div>
      <div class="row">
        <div class="active-item-draw-amnt"> SGD {{ $price }} </div>
      </div>
      <div class="row">

        @if(session('user_id') == 1)
          <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
            <a href="/d/m/d?a=2&d={{ $id }}&p={{ $product }}&m=d"
             id="btn-draw_management_edit-{{ $id }}"
             class="btn btn-primary btn-draw-kenji btn-draw_management_edit">Edit</a>
          </div>
        @else
          <div class="col-xs-6 col-sm-6 col-md-6">
              <a href="/p/d/s?p={{ $product }}&m=h&d={{ $id }}" id="btn-draw_management_buy-{{ $id }}"
                   class="pull-right btn btn-primary btn-draw-buy-kenji btn-draw_management_buy" data-id="{{ $id }}">Buy</a>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
              <a id="btn-draw_management_join-{{ $id }}"
                   class="btn btn-primary btn-draw-kenji btn-draw_management_join" data-id="{{ $id }}">Draw</a>
          </div>
        @endif

      </div>
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-xs-6 col-sm-4 col-md-3"> -->
