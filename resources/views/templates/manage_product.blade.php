<div class="col-xs-6 col-sm-4 col-md-3">
    <div class="thumbnail">
        @if($id !== '#')
            <a href="/p/d/s?p={{ $id }}&m=p">
                <img src="{{ asset($img) }}" alt=""/>
            </a>
        @else
            <img src="{{ asset($img) }}" alt=""/>
        @endif
        <div class="caption">
            <div class="bid-title">{{ $name }}</div>
        @if ($id != 0)
            <!-- <div class="pull-left bid-time">Qty: {{ $quantity }}</div> -->
            @endif
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-xs-6 col-sm-4 col-md-3"> -->
