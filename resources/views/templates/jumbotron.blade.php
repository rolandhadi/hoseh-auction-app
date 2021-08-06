<div class="slide-product text-center" style="margin-bottom: 0;">
    <div class="row">
        <div class="col-sm-12">
            <!-- <div class="ribbon-wrapper-green">
                <div class="ribbon-green"><span>TESTING</span></div>
            </div> -->
            @if(session('user_id') == 1)
              <form data-ajax="false" id="frm-jumbotron-img_01" action="/c/b/i?b=01" method="POST"
                    enctype="multipart/form-data" name="form">
                  {{ csrf_field() }}
                  <input id="txt-jumbotron-id_01" class="hide" name="p" value="/c/b/i?b=01"
                         data-id="1">
                  <input id="txt-jumbotron-img-path_01" type="file" class="hide" name="image"
                         onChange="jumbotron_img_path_change('01');" accept="image/x-png"/>
                  <button type="button" id="btn-jumbotron-add-image_01" class="product-button-add"
                          onclick="jumbotron_img_path_click('01');">
                      <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                  </button>
              </form>

              <button type="button" id="btn-jumbotron-update-image_01" class="product-button-remove"
                      onclick="jumbotron_img_update_click('1');">
                  <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
              </button>
            @endif
            <a href="{{ $banners[0] }}">
                <img class="jumbotron-img" src="{{ asset('img/main-banner-01.png') }}" alt=""/>
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- <div class="ribbon-wrapper-green">
                <div class="ribbon-green"><span>TESTING</span></div>
            </div> -->
            @if(session('user_id') == 1)
              <form data-ajax="false" id="frm-jumbotron-img_02" action="/c/b/i?b=02" method="POST"
                    enctype="multipart/form-data" name="form">
                  {{ csrf_field() }}
                  <input id="txt-jumbotron-id_02" class="hide" name="p" value="/c/b/i?b=02"
                         data-id="1">
                  <input id="txt-jumbotron-img-path_02" type="file" class="hide" name="image"
                         onChange="jumbotron_img_path_change('02');" accept="image/x-png"/>
                  <button type="button" id="btn-jumbotron-add-image_02" class="product-button-add"
                          onclick="jumbotron_img_path_click('02');">
                      <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                  </button>

                  <button type="button" id="btn-jumbotron-update-image_02" class="product-button-remove"
                          onclick="jumbotron_img_update_click('2');">
                      <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                  </button>
              </form>
            @endif
            <a href="{{ $banners[1] }}">
                <img class="jumbotron-img" src="{{ asset('img/main-banner-02.png') }}" alt=""/>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- <div class="ribbon-wrapper-green">
                <div class="ribbon-green"><span>TESTING</span></div>
            </div> -->
            @if(session('user_id') == 1)
              <form data-ajax="false" id="frm-jumbotron-img_03" action="/c/b/i?b=03" method="POST"
                    enctype="multipart/form-data" name="form">
                  {{ csrf_field() }}
                  <input id="txt-jumbotron-id_03" class="hide" name="p" value="/c/b/i?b=03"
                         data-id="1">
                  <input id="txt-jumbotron-img-path_03" type="file" class="hide" name="image"
                         onChange="jumbotron_img_path_change('03');" accept="image/x-png"/>
                  <button type="button" id="btn-jumbotron-add-image_03" class="product-button-add"
                          onclick="jumbotron_img_path_click('03');">
                      <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                  </button>

                  <button type="button" id="btn-jumbotron-update-image_03" class="product-button-remove"
                          onclick="jumbotron_img_update_click('3');">
                      <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                  </button>
              </form>
            @endif
            <a href="{{ $banners[2] }}">
                <img class="jumbotron-img" src="{{ asset('img/main-banner-03.png') }}" alt=""/>
            </a>
        </div>
    </div>
</div>

@if(session('user_id') == 1)
  <script>

      function jumbotron_img_path_click(id) {
          var img_path = document.getElementById("txt-jumbotron-img-path_" + id);
          img_path.click();
      }

      function jumbotron_img_update_click(id) {
        swal({
            title: "Add Banner Link",
            text: "Enter URL for banner " + id,
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "http://hoseh.com/p/d/s?p=1&m=h&d=1"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("A valid hyperlink is required!");
                return false
            }
            if (isUrlValid(inputValue) == false) {
              swal.showInputError("A valid hyperlink is required!");
              return false
            }
            $.post('/c/u/b', {
                'i': id,
                'u': inputValue,
            }, function (rx) {
                if (!rx[0]) {
                    swal.showInputError(xssFilter(rx[1]));
                    return false
                }
                else {
                    swal({
                        title: xssFilter(rx[1]),
                        text: xssFilter(rx[2]),
                        type: 'success',
                        timer: 30000,
                        showConfirmButton: true
                    }, function () {
                        window.location.href = '/';
                    });
                }
            });
        });
      }

      function isUrlValid(url) {
          return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
      }

      function jumbotron_img_path_change(id) {
          if ($("txt-jumbotron-img-path_" + id).val() != '')
              var img_path = document.getElementById("txt-jumbotron-img-path_" + id);
      }

      $("#txt-jumbotron-img-path_01").change(function () {
          $("#frm-jumbotron-img_01").submit();
      });
      $("#txt-jumbotron-img-path_02").change(function () {
          $("#frm-jumbotron-img_02").submit();
      });
      $("#txt-jumbotron-img-path_03").change(function () {
          $("#frm-jumbotron-img_03").submit();
      });
  </script>
@endif
