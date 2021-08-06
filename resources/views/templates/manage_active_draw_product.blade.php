<div class="col-xs-6 col-sm-4 col-md-3">
    <div class="thumbnail">
        <a href="/p/d/s?p={{ $product }}&m=d&d={{ $id }}">
            <img src="{{ asset($img) }}" alt=""/>
        </a>
        <div class="caption">
            <div class="bid-title">{{ $name }}</div>
            <div id="draw-time-{{ $id }}" class="pull-left bid-time active-draw" data-id="{{ $id }}"></div>
            <div class="pull-right"><a href="/d/m/d?a=2&d={{ $id }}&p={{ $product }}&m=d"
                                       id="btn-draw_management_edit-{{ $id }}"
                                       class="btn btn-primary btn-bid btn-draw_management_edit">Edit</a></div>
        </div> <!-- <div class="caption"> -->
    </div> <!-- <div class="thumbnail"> -->
</div> <!-- <div class="col-xs-6 col-sm-4 col-md-3"> -->
