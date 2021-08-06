<div class="{{ $thumbsize }}">
    <div class="thumbnail">
        <div class="row">
            <div id="bid-time-{{ $id }}" class="bid-time-kenji active-bid" data-id="{{ $id }}"></div>
        </div>
        <div class="row">
        @if($product !== '#')
            <a href="/p/d/s?p={{ $product }}&m=hb&b={{ $id }}">
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
        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="active-item-amnt"> {{ $bid_amount }}  </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
          @if(session('user_id') == 1)
            <a href="/b/m/d?a=2&b={{ $id }}&p={{ $product }}&m=b"
             id="btn-bid_management_edit-{{ $id }}"
             class="btn btn-primary btn-bid-kenji btn-bid_management_edit">Edit</a>
          @else
            <a id="btn-bid_management_join-{{ $id }}"
                 class="btn btn-primary btn-bid-kenji btn-bid_management_join" data-id="{{ $id }}">Bid</a>
          @endif
        </div>
      </div>
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-xs-6 col-sm-4 col-md-3"> -->
