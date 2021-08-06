@extends('layouts.master')

@section('content')

<div class="container">
  <br>
  <div class="row" style="margin-top: 50px;">
    <div class="login-pane" style="padding: 10px;">
      <ul class="nav nav-pills">
        <li role="presentation"><a href="/r">User Payments</a></li>
        <li role="presentation"><a href="/r/ad">Active Lucky Draws</a></li>
        <li role="presentation"><a href="/r/d">Lucky Draws</a></li>
        <li role="presentation"><a href="/r/b">Auctions</a></li>
        <li role="presentation" class="active"><a href="#">Lucky Draw Winners{!! $draws['draw_delivery'] !!}</a></li>
        <li role="presentation"><a href="/r/b/w">Auction Winners{!! $draws['bid_delivery'] !!}</a></li>
        <li role="presentation"><a href="/r/p/p/d">Lucky Draw Purchases{!! $draws['draw_purchase_delivery'] !!}</a></li>
        <li role="presentation"><a href="/r/p/p/b">Auction Purchases{!! $draws['bid_purchase_delivery'] !!}</a></li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="login-pane" style="min-height: 500px;">
        <h1 class="title-header">Lucky Draw Winners History</h1>
        <div class="report-container">
          <a href="/r/e/ldw">
            <button id="btn-export-to-excel" class="btn btn-danger btn-sm pull-right" type="button" style="margin-bottom:15px;">Export To Excel</button>
          </a>
          <table class="table table-bordered table-striped table-hover">
          	<thead>
          		<tr>
          			<th>
          				Date
          			</th>
          			<th>
          				Email
          			</th>
          			<th>
          				Draw ID
          			</th>
          			<th>
          				Item Name
          			</th>
                <th>
          				Remarks
          			</th>
                <th>

          			</th>
          		</tr>
          	</thead>
          	<tbody>
             @if(!empty($draws['draws']))
               @foreach($draws['draws'] as $draw)
            		<tr>
            			<td>
            				{{ $draw['created_at'] }}
            			</td>
            			<td>
                    <a href="/u/u?u={{ $draw['winner_id'] }}">
        				      {{ $draw['email'] }}
                    </a>
            			</td>
            			<td>
                    <a href="/p/d/s?p={{ $draw['product_id'] }}&m=rdw&d={{ $draw['draw_id'] }}">
        				      {{ 'D' . str_pad($draw['draw_id'], 6, '0', STR_PAD_LEFT) }}
                    </a>
            			</td>
            			<td>
            				{{ $draw['item_name'] }}
            			</td>
                  <td>
                    @if($draw['item_status'] == 3)
                      @if($draw['email'] !== '')
                        <button class="btn btn-warning btn-sm report-action btn-action" type="button" data-id="{{ $draw['draw_id'] }}">For Delivery</button>
                      @else
                        <button class="btn btn-error btn-sm report-action" type="button">No Winner</button>
                      @endif
                    @elseif($draw['item_status'] == 4)
                      <button class="btn btn-primary btn-sm report-action" type="button" data-id="{{ $draw['draw_id'] }}">Delivered</button>
                    @else
                      <button class="btn btn-warning btn-sm report-action" type="button">
                        Not Paid
                      </button>
                    @endif
            			</td>
                  <td class="report-table">
            				<img class="product-report-thumbnail" src="{{ asset($draw['item_image']) }}" />
            			</td>
            		</tr>
               @endforeach
              @endif
          	</tbody>
          </table>
        </div>
        <br>
        <div class="pagination"> {{ $draws['users_draw_history'] }} </div>
        <br>
        <h2 class="title-header">Total: {{ $draws['users_draw_total'] }}</h2>
      </div>
    </div>
  </div>
</div>

<script>
  $('.report-action').on('click', function(e){
    var id = $(e.target).data('id');

    $.post('/r/d/w/a', {
        'a': xssFilter(id)
      }, function (rx) {
        if (!rx[0]) {
          swal({title: xssFilter(rx[1]),
                timer: 10000,
                showConfirmButton: true
          });
        }
        else {
          var $textAndPic = $('<div></div>');
          $textAndPic.append(rx[2]);

          BootstrapDialog.show({
              title: rx[1],
              message: $textAndPic,
              buttons: [{
                  label: 'Deliver',
                  action: function(){
                    swal({title: 'Mark as Delivered?',
                          text: 'Are you sure you want to mark as delivered this item?',
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Deliver",
                          showLoaderOnConfirm: true,
                          closeOnConfirm: false
                      },
                      function(){
                        setTimeout(function(){
                          $.post('/r/d/w/a/d', {
                            'a': xssFilter(id)
                          }, function(rx) {
                              swal({title: rx[1],
                                    text: rx[2],
                                    type: rx[3],
                                    timer: 30000,
                                    showConfirmButton: true
                              }, function(){
                                window.location.href = '/r/d/w';
                              });
                          });
                      }, 3000);
                    });
                  }
              }, {
                  label: 'Cancel',
                  action: function(dialogRef){
                      dialogRef.close();
                  }
              }]
          });
        }
    });
  });
</script>

@endsection
