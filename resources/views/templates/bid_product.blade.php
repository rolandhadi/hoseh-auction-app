<div class="col-sm-12">
    <div class="thumbnail completed-bids">
        @if($id !== '#')
            <a href="/p/d/s?p={{ $id }}&m=b">
                <img src="{{ $img }}" alt=""/>
            </a>
        @else
            <img src="{{ $img }}" alt=""/>
        @endif
        <div class="caption">
            <div class="bid-title">{{ $name }}</div>
            <div class="bid-caption">
            <!-- <div class="pull-left bid-time">{{ $quantity }}</div> -->
                <div class="pull-right"><a href="/d/m/d?a=1&p={{ $id }}&m=b" id="btn-bid_management_add-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-bid_management_add">Add</a></div>
            </div>
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-sm-12"> -->
