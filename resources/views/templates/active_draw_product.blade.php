<div class="{{ $thumbsize }}">
    <div class="thumbnail">
        @if($joined > 0)
            <div id="draw-joined-{{ $id }}" class="ribbon-wrapper-green">
                <div id="draw-joined-text-{{ $id }}" class="ribbon-green">{{ $joined }} <span
                            class="glyphicon glyphicon-thumbs-up"></span></div>
            </div>
        @else
            <div id="draw-joined-{{ $id }}" class="ribbon-wrapper-green hidden">
                <div id="draw-joined-text-{{ $id }}" class="ribbon-green"><span
                            class="glyphicon glyphicon-thumbs-up"></span></div>
            </div>
        @endif
        @if($product !== '#')
            <a href="/p/d/s?p={{ $product }}&m=h&d={{ $id }}">
                <img src="{{ asset($img) }}" alt=""/>
            </a>
        @else
            <img src="{{ asset($img) }}" alt=""/>
        @endif
        <div class="caption">
            <div class="bid-title">{{ $name }}</div>
            <div id="draw-time-{{ $id }}" class="pull-left bid-time active-draw" data-id="{{ $id }}"></div>
            @if(session('user_id') == 1)
                <div class="pull-right"><a href="/d/m/d?a=2&d={{ $id }}&p={{ $product }}&m=d"
                                           id="btn-draw_management_edit-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-draw_management_edit">Edit</a></div>
            @else
                <div class="pull-right"><a id="btn-draw_management_join-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-draw_management_join" data-id="{{ $id }}">Join</a>
                </div>
                <div class="pull-right"><a href="/p/d/s?p={{ $product }}&m=h&d={{ $id }}"
                                           id="btn-draw_management_buy-{{ $id }}"
                                           class="btn btn-primary btn-bid btn-buy  btn-draw_management_buy"
                                           data-id="{{ $id }}">Buy</a></div>
            @endif
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-xs-6 col-sm-4 col-md-3"> -->
