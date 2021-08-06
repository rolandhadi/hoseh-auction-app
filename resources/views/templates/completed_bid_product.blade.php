<div class="col-sm-12">
    <div class="thumbnail completed-bids">
        @if($winner !== '')
            <span class="label-save">Saved <i>{{ $savings }}%</i></span>
            <div class="ribbon-wrapper-green">
                <div class="ribbon-green">{{ $winner }}</div>
            </div>
        @endif
        <img src="{{ $img }}" alt=""/>
        <div class="caption">
            @if($product != '#')
                <a href="/p/d/s?p={{ $product }}&m=hb&b={{ $id }}">
                    <div class="bid-title">{{ $name }}</div>
                    <br>
                    <div id="txt-bid_management_bid-amount-{{ $id }}" class="bid-amt-winner">{{ $bid_amount }}</div>
                </a>
            @else
                <div class="bid-title">{{ $name }}</div>
                <br>
                <div id="txt-bid_management_bid-amount-{{ $id }}" class="bid-amt-winner">{{ $bid_amount }}</div>
            @endif
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-sm-12"> -->
