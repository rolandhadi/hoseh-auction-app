<footer class="footer">
	<div class="inner-footer">
			<div class="row nav-bottom">
				<div id="about-footer">
					{!! App\Http\Controllers\AboutController::get_footer() !!}
			</div>
		</div>
			<hr />
			<div class="copyright">
				<div class="col-sm-6">
					<span>&copy; Copyright 2016 hoseh.com All right reserved</span>
				</div>
				@if(session('user_id') == 1)
					<a href="#" id="btn-footer-update" class="btn btn-primary pull-right" type="button">Update Footer</a>
				@endif
			</div>
		</div>
</footer>

@if(session('user_id') == 1)
  <script>
    $('.about-footer').attr('contenteditable','true');
    $('#btn-footer-update').on('click', function(){
        var f = $('#about-footer').html();
        $.post('/f/u', {
          'f': f
        }, function(rx) {
          swal({title: xssFilter(rx[1]),
                type: xssFilter(rx[2]),
                timer: 10000,
                showConfirmButton: true
          });
        });
    });
  </script>
@else
  <script>
    $('.about-footer').attr('contenteditable','false');
  </script>
@endif
