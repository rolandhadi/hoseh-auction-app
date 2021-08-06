<div class="col-sm-12">
    <div class="thumbnail completed-bids">
        <img src="{{ $img }}" alt=""/>
        <div class="caption">
            <a href="/p/d/s?p={{ $id }}&m=d">
                <div class="bid-title">{{ $name }}</div>
            </a>
            <div class="bid-caption">
            <!-- <div class="pull-left bid-time">Qty: {{ $quantity }}</div> -->
                <div class="pull-right"><a href="/d/m/d?a=1&p={{ $id }}&m=d" id="btn-draw_management_add-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-draw_management_add">Add</a></div>
            </div>
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-sm-12"> -->
