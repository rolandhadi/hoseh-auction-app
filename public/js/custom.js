//global
var winWidth;
function checkWidthSize() {
    winWidth = $(window).width();
}

// function ScrollHeader() {
// 	var ToHeader = $('header');
// 	var scrollInterval = function() {
// 	        	ToHeader.addClass("down");
// 	        };
// 	var scrollChecker = function () {
//         if ($(this).scrollTop() > 200) {
//             ToHeader.addClass('scroll');
//             $(".nav-main, .wrapper").addClass('scroll');
//             setTimeout(scrollInterval, 200);
//         } else {
//             ToHeader.removeClass('scroll down');
//             $(".nav-main, .wrapper").removeClass('scroll');
//             $(".search, .search-toggle").removeClass("active");
//         }
//     };
//     scrollChecker();
//     $(window).scroll(scrollChecker);
// }

function ZoomElevate() {
    $('.img-product .large').elevateZoom({
		gallery: 'product-thumbnails',
		zoomType: "lens",
		containLensZoom: true,
		galleryActiveClass: "active"
	});
	return false;
}

function ZoomOwlCarousel() {
	if(winWidth < 767) {
		$('#product-thumbnails .item').zoom({
			on:'toggle',
	        touch: false
		});
	} else {
		$('#product-thumbnails .item').trigger('zoom.destroy'); // remove zoom
	}
}

function hoseh_join_bid(e) {
  var id = $(e.target).data('id');
  $(e.target).attr("disabled", true);
  $.post('/b/j', {
      'b': id
  }, function(rx){
    if (rx[0]) {
      $('#bid-joined-' + id).removeClass('hidden')
      swal({title: xssFilter(rx[1]),
            timer: 2000,
            showConfirmButton: true
      });
      $('#btn-dashboard-tokens').text('Tokens ( ' + xssFilter(rx[2]) + ' )')
    }
    else {
      if (rx[1] == 'redirect') {
        window.location.href = xssFilter(rx[2]);
      }
      else if (rx[1] == 'Insufficient Token') {
        swal({title: xssFilter(rx[1]),
              text: xssFilter(rx[2]),
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Buy Tokens!",
              closeOnConfirm: true
          },
          function(){
            window.location.href = '/u/p/s';
          });
      }
      else {
        swal({title: xssFilter(rx[1]),
              text: xssFilter(rx[2]),
              timer: 5000,
              showConfirmButton: true
        },
        function(){

        });
      }
    }
    $(e.target).attr("disabled", false);
  });
}


function hoseh_join_draw(e) {
  var id = $(e.target).data('id');
  $(e.target).attr("disabled", true);
  $.post('/d/j', {
      'd': id
  }, function(rx){
    if (rx[0]) {
      $('#draw-joined-' + id).removeClass('hidden');
      swal({title: xssFilter(rx[1]),
            timer: 2000,
            showConfirmButton: true
      });
      $('#btn-dashboard-tokens').text('Tokens ( ' + xssFilter(rx[2]) + ' )')
    }
    else {
      if (rx[1] == 'redirect') {
        window.location.href = xssFilter(rx[2]);
      }
      else if (rx[1] == 'Insufficient Token') {
        swal({title: xssFilter(rx[1]),
              text: xssFilter(rx[2]),
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Buy Tokens!",
              closeOnConfirm: true
          },
          function(){
            window.location.href = '/u/p/s';
          });
      }
      else {
        swal({title: xssFilter(rx[1]),
              text: xssFilter(rx[2]),
              timer: 5000,
              showConfirmButton: true
        },
        function(){

        });
      }
    }
    $(e.target).attr("disabled", false);
  });
}

function hoseh_update_draws () {
  var active_draws = $(".active-draw").map(function() {
       return $(this).data('id');
   }).get();
  if (active_draws.length) {
    $.post('/d/at',
    {'d':active_draws},
    function(rx) {
      for(var k in rx) {
        if (rx[k]['s'] == 2) {
          $('#draw-time-' + k).text('Processing...');
          $('#draw-time-' + k).fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
          $('.hide-on-processing').css('visibility', 'hidden');
          $('#btn-draw_management_join-'+ k).css('visibility', 'hidden');
          $('#btn-draw_management_buy-'+ k).css('visibility', 'hidden');
          $('#btn-draw_management_edit-'+ k).css('visibility', 'hidden');
          $('#bid-time-' + k).css('color', 'red');
        }
        else if (rx[k]['s'] == 3) {
          $('#draw-joined-' + k).removeClass('hidden')
          $('#draw-joined-text-' + k).text(rx[k]['w']);
          $('#draw-time-' + k).text('Completed');
        }
        else if (rx[k]) {
          $('#draw-time-' + k).text("Time Left: " + hoseh_format_time(rx[k]));
          if (rx[k] <= 10) {
            $('#draw-time-' + k).css('color', 'red');
          }
          else {
            $('#draw-time-' + k).css('color', '#444');
          }
        }
      }
    });
  }
}

function hoseh_update_bids () {
  var active_bids = $(".active-bid").map(function() {
       return $(this).data('id');
   }).get();
  if (active_bids.length) {
    $.post('/b/at',
    {'b':active_bids},
    function(rx) {
      for(var k in rx) {
        if (rx[k]['s'] == 2) {
          $('#bid-time-' + k).text('Processing...');
          $('#bid-time-' + k).fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
          $('.hide-on-processing').css('visibility', 'hidden');
          $('#btn-bid_management_join-'+ k).css('visibility', 'hidden');
          $('#btn-bid_management_buy-'+ k).css('visibility', 'hidden');
          $('#btn-bid_management_edit-'+ k).css('visibility', 'hidden');
          $('#txt-bid_management_last_bidder-'+ k).css('visibility', 'hidden');
          $('#bid-time-' + k).css('color', 'red');
        }
        else if (rx[k]['s'] == 3) {
          $('#bid-joined-' + k).removeClass('hidden')
          $('#bid-joined-text-' + k).text(rx[k]['w']);
          $('#bid-time-' + k).text('Completed');
        }
        else if (rx[k]) {
          if (rx[k][1] !== '') {
            $('#bid-joined-text-' + k).text(rx[k][1]);
            $('#bid-joined-' + k).removeClass('hidden');
          }
          $('#bid-time-' + k).text(rx[k][3] + " Bid(s) " + hoseh_format_time(rx[k][0]) + " left");
          $('#txt-bid_management_last_bidder-' + k).text(rx[k][1]);
          $('#txt-bid_management_bid-amount-' + k).text('S$ ' + rx[k][2]);
          if (rx[k] <= 10) {
            $('#bid-time-' + k).css('color', 'red');
          }
          else {
            $('#bid-time-' + k).css('color', '#444');
          }
        }
      }
    });
  }
}

function xssFilter(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
}


function hoseh_format_time(secs) {
  // var hr = Math.floor(secs / 3600);
  // var min = Math.floor((secs - (hr * 3600))/60);
  // var sec = secs - (hr * 3600) - (min * 60);
  // if (hr < 10) {hr = "0" + hr; }
  // if (min < 10) {min = "0" + min;}
  // if (sec < 10) {sec = "0" + sec;}
  // return hr + ':' + min + ':' + sec;

  var days = Math.floor(secs / 86400);
  secs -= days * 86400;
  var hr = Math.floor(secs / 3600) % 24;
  secs -= hr * 3600;
  var min = Math.floor(secs / 60) % 60;
  secs -= min * 60;
  var sec = secs % 60;
  var out = '';
  if (days) {
    out += days + 'D ';
  }
  if (hr) {
    out += hr + 'H ';
  }
  out += min + '.' + sec;
  return out;
}

$(function(){

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

	$(".inner-nav-main > li > a").click(function() {
		if ($(this).parent().find(".nav-sub").length > 0) {
			$(this).parent().toggleClass("active");
			$(".nav-sub").slideToggle().toggleClass("active");
			if ($(".nav-sub").hasClass("active")) {
				$(this).find("i").replaceWith("<i class='fa fa-angle-down'></i>");
			} else {
				$(this).find("i").replaceWith("<i class='fa fa-angle-right'></i>");
			}
		}
	});

	$(".nav-toggle").click(function() {
		$(".nav-main").toggleClass("active");
	});

	$(".search-toggle").click(function() {
		$(".search, .search-toggle").toggleClass("active");
	});

	$(".sub-menu > a").click(function(e) {
		e.preventDefault();
		if ($(this).parent().hasClass("active")) {
			$(this).find("span").replaceWith("<span class='fa fa-angle-right'></span>");
		} else {
			$(this).find("span").replaceWith("<span class='fa fa-angle-down'></span>");
		}
	});

	$('.panel-heading a[data-toggle="collapse"]').on('click', function () {
		$('.panel-heading a[data-toggle="collapse"]').removeClass('active');
		$('.panel-heading a[data-toggle="collapse"]').parent().parent().parent().removeClass('active');
		$(this).addClass('active');
		$(this).parents().eq(2).addClass('active');
	});

	$(".sub-menu .sub-menu-toggle").click(function(e) {
		e.preventDefault();
		$(this).parent().toggleClass("active");
	});

	if($('.product').length >=1) {
		$("#product-thumbnails").owlCarousel({
			navigation: true,
			pagination: false,
			navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
			itemsDesktopSmall : [960,4],
			itemsTablet : [752, 1],
			touchDrag : false,
			lazyLoad : false,
			responsiveRefreshRate : 0
		});
	}

	$(".list-slide").owlCarousel({
		navigation: true,
		pagination: false,
		navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		itemsCustom : [
			[0, 2],
			[540, 2],
			[752, 4],
			[960, 6]
			]
	});

	$(".slide-product").owlCarousel({
		navigation: true,
		navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		singleItem: true,
		touchDrag : true
	});

	setTimeout(function() {
		$(".list-thumbnail .caption h3, .list-thumbnail .caption p").dotdotdot();
		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			$(".list-thumbnail .caption h3, .list-thumbnail .caption p").dotdotdot(e);
		});
	}, 100);

	if ($(".thumbnail > a > img").hasClass("hover")) {
		$(this).addClass("image");
	}

	/*qty button*/
	$(".ddd").on("click", function(e) {
		e.preventDefault();

	    var $button = $(this);
	    var oldValue = $button.closest('.quantity').find("input.quntity-input").val();

	    if ($button.text() == "+") {
	        var newVal = parseFloat(oldValue) + 1;
	    } else {
	        // Don't allow decrementing below zero
	        if (oldValue > 0) {
	            var newVal = parseFloat(oldValue) - 1;
	        } else {
	            newVal = 0;
	        }
	    }
	    $button.closest('.quantity').find("input.quntity-input").val(newVal);
	});

	$("#form-contact").validate({
		submitHandler: function(form) {
			$.ajax({
				type: "post",
				url: "contact-send.php",
				data: $("#form-contact").serialize(),
				success: function() {
					$('#form-contact').html('Edit text "custom.js"');
				}
			})
		}
	});

	/*$('.carousel.slide').carousel({
		interval: 7500
	})*/

	// $( "#slider-range" ).slider({
	// 	range: true,
	// 	min: 0,
	// 	max: 500,
	// 	values: [ 75, 300 ],
	// 	slide: function( event, ui ) {
	// 		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
	// 	}
	// });
	// $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	// 	" - $" + $( "#slider-range" ).slider( "values", 1 ) );
  //
	// $('#slider-range').draggable();
  //
	// $("#validate-form").validate();

	// ScrollHeader();
	checkWidthSize();
	ZoomElevate();
	ZoomOwlCarousel();

});

$(window).resize(function() {
	checkWidthSize();
	$('.zoomContainer').remove();
	ZoomElevate();
	ZoomOwlCarousel();
});
