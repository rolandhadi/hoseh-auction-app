<!DOCTYPE html>
<html>
<head>	
	<title>Twenty one : Contact us</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="user-scalable=0,initial-scale=1.0, maximum-scale=1, minimum-scale=1" />
	<?php include "css.php"; ?>
	<?php include "script.php"; ?>
</head>
<body>
	<div class="wrapper">
		<?php include "header.php"; ?>
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="active">Contact us</li>
		    </ol>
		    <h1 class="title-header">Contact us</h1>
			<div class="row">
				<div class="col-md-8">
					<div id="map"></div>
				</div>
				<div class="col-md-4">
					<h2>Information</h2>
					<ul class="contact-list">
						<li>
							<label><i class="fa fa-map-marker"></i></label>
							<span>23/ 456 Jaransanitwong 35 Jaransanitwong Road Bangkoknoi Bangkok</span>
						</li>
						<li>
							<label><i class="fa fa-envelope"></i></label>
							<span>info@north21.com</span>
						</li>
						<li>
							<label><i class="fa fa-phone"></i></label>
							<span>+66 2 123 4567</span>
						</li>
						<li>
							<label><i class="fa fa-fax"></i></label>
							<span>+66 2 123 4567</span>
						</li>
					</ul>
					<form method="post" action="#" enctype="multipart/form-data" id="form-contact">
						<div class="form">
							<div class="form-group">
								<input type="text" placeholder="Name Surname" name="name" class="form-control required">
							</div>
							<div class="form-group">
								<input type="email" placeholder="Email" name="email" class="form-control required email">
							</div>
							<div class="form-group">
								<input type="text" placeholder="Telephone" name="telephone" class="form-control required number">
							</div>
							<div class="form-group">
								<textarea rows="4" placeholder="Massage" name="massage" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<div class="QapTcha"></div>
							</div>
							<div class="form-group text-right">
								<button class="btn btn-default"> Cancel</button>
								<input type="submit" class="btn btn-primary" value="Submit">
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	<?php include "footer.php"; ?>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> 
    <script type="text/javascript">
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);
    
        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
				scrollwheel: false,
                zoom: 13,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(13.821862, 100.497616), // Thailand

                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                styles: [{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]/**/},{featureType:"administrative.locality",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",stylers:[{visibility:"on"}]/**/},{featureType:"water",elementType:"labels",stylers:[{visibility:"on"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}]
            };
			var contentString = '<div id="mapcontent">'+
                            '<p>Welcome to Thailand</p></div>';
			var infowindow = new google.maps.InfoWindow({
				maxWidth: 320,
				content: contentString
			});

            // Get the HTML DOM element that will contain your map 
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('map');

            // Create the Google Map using out element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);
			var image = new google.maps.MarkerImage('assets/img/pin.png',
            null, null, null, new google.maps.Size(64, 64))
			
			var myLatLng = new google.maps.LatLng(13.821862, 100.497616);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				icon: image
			});
	
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});
        }
    </script>
</body>
</html>