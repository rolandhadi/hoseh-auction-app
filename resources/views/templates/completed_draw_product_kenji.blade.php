<div class="col-sm-12">
    <div class="thumbnail completed-bids">
        @if($winner !== '')
            <div class="row">
                <div class="completed-draw-winner"><b>Winner: </b>{{ $winner }}</div>
            </div>
        @endif
        <img src="{{ $img }}" alt=""/>
        <div class="caption" style="margin-bottom:-35px;">
            @if($product != '#')
                <div class="row" style="margin-bottom:-3px;">
                  <div class="completed-item-name"> {{ $name }} </div>
                </div>
                <div class="row" style="margin-bottom:5px;">
                  <div class="completed-item-draw-amnt"> SGD {{ $price}} </div>
                </div>
                <div class="row" style="text-align: center;">
                  <a href="/p/d/s?p={{ $product }}&m=h&d={{ $id }}"
                       class="btn btn-primary btn-draw-buy-kenji btn-draw_management_buy" data-id="{{ $id }}">Buy</a>
                </div>
            @else
                <div class="bid-title">{{ $name }}</div>
            @endif
            <br>
            <br>
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-sm-12"> -->
