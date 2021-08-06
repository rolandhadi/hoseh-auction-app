<div class="{{ $thumbsize }}">
    <div class="thumbnail">
        @if($last_bidder !== '')
            <div id="bid-joined-{{ $id }}" class="ribbon-wrapper-green">
                <div id="bid-joined-text-{{ $id }}" class="ribbon-green"><span
                            id="txt-bid_management_last_bidder-{{ $id }}">{{ $last_bidder }}</span></div>
            </div>
        @else
            <div id="bid-joined-{{ $id }}" class="ribbon-wrapper-green hidden">
                <div id="bid-joined-text-{{ $id }}" class="ribbon-green"><span
                            id="txt-bid_management_last_bidder-{{ $id }}">{{ $last_bidder }}</span></div>
            </div>
        @endif
        @if($product !== '#')
            <a href="/p/d/s?p={{ $product }}&m=hb&b={{ $id }}">
                <img src="{{ asset($img) }}" alt=""/>
            </a>
        @else
            <img src="{{ asset($img) }}" alt=""/>
        @endif
        <div class="caption">
            <div id="txt-bid_management_bid-amount-{{ $id }}" class="bid-amt"> {{ $bid_amount }} </div>
            <div class="bid-title">{{ $name }}</div>
            <div id="bid-time-{{ $id }}" class="pull-left bid-time active-bid" data-id="{{ $id }}"></div>
            @if(session('user_id') == 1)
                <div class="pull-right"><a href="/b/m/d?a=2&b={{ $id }}&p={{ $product }}&m=b"
                                           id="btn-bid_management_edit-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-bid_management_edit">Edit</a></div>
            @else
                <div class="pull-right"><a id="btn-bid_management_join-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-bid_management_join" data-id="{{ $id }}">Bid</a>
                </div>
                <div class="pull-right"><a href="/p/d/s?p={{ $product }}&m=hb&b={{ $id }}"
                                           id="btn-bid_management_buy-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-buy btn-bid_management_buy"
                                           data-id="{{ $id }}">Buy</a></div>
            @endif
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-xs-6 col-sm-4 col-md-3"> -->
