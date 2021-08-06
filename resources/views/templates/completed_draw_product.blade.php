<div class="col-sm-12">
    <div class="thumbnail completed-bids">
        @if($winner !== '')
            <div class="ribbon-wrapper-green">
                <div class="ribbon-green">{{ $winner }}</div>
            </div>
        @endif
        <img src="{{ $img }}" alt=""/>
        <div class="caption">
            @if($product != '#')
                <a href="/p/d/s?p={{ $product }}&m=h&d={{ $id }}">
                    <div class="bid-title">{{ $name }}</div>
                </a>
            @else
                <div class="bid-title">{{ $name }}</div>
            @endif
            <br>
            <br>
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-sm-12"> -->
