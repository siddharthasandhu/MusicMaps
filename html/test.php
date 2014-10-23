<!DOCTYPE html>
<html>
  <head>
  <?php
     $user="root";
     $password="";
     $database="muzicmap";
     $con=mysqli_connect("localhost",$user,$password,$database);
     if (mysqli_connect_errno()) {
             echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
     $query="SELECT DISTINCT (
             `name`
             ) AS `name` , `id` , `location` , `background` , `genre` , `current_members` , `website` , `image`
             FROM `artist`
             WHERE `location` LIKE '%Los Angeles%'
             LIMIT 50 
             ";
     $result=mysqli_query($con,$query);
     mysqli_close();
	?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>

     <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBksABPLVD8PHbO9VS4cPT7mKDsP8V14HY&sensor=false&libraries=drawing">
    </script>
    <script type="text/javascript">
    result = "<?php echo $result; ?>";
	markers= []
    function initialize() {
  		var mapOptions = {
    			zoom: 4,
    			center: new google.maps.LatLng(40.2859268188,-75.9843826294)
  		}
  		var map = new google.maps.Map(document.getElementById('map-canvas'),
                                mapOptions);
  		var drawingManager = new google.maps.drawing.DrawingManager({
    		drawingMode: google.maps.drawing.OverlayType.MARKER,
    		drawingControl: true,
    		drawingControlOptions: {
      		position: google.maps.ControlPosition.TOP_CENTER,
      		drawingModes: [
        			google.maps.drawing.OverlayType.CIRCLE,
      			]
    			},
    	circleOptions: {
      	fillColor: '#FFFF00',
      	fillOpacity: 0,
      	strokeWeight: 1,
      	clickable: false,
      	editable: true,
      	zIndex: 1
    		}
  		});
  		drawingManager.setMap(map);
		google.maps.event.addListener(drawingManager, 'circlecomplete', function(circle) {
    				var IDs=[];
 					for(var k in markers){
     					if(google.maps.geometry.spherical
        					.computeDistanceBetween(circle.getCenter(),markers[k].getPosition())
          					<=circle.getRadius()){
        					IDs.push(k);
     					}
 					}
   		});
  		adMarker(map, result);
  		var myParser = new geoXML3.parser({map: map});
    	myParser.parse('my_geodata.kml');

		}
		
      function adMarker(map,locations){
      	
			for (var i = 0; i < locations.length; i++) {
    				var beach = locations[i];
    				var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
    				var marker = new google.maps.Marker({
        			position: myLatLng,
        			map: map,
        			title: beach[0],
        			zIndex: beach[3]
    				});
    				markers.push(marker);
    				
  				}
   		
      }


      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
  

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"/>

  </body>
</html>
