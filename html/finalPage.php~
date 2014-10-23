<html>
<head>
<style type="text/css">
body {background-image:url("love-and-music1.jpg");
		font-family: 'Helvetica', 'Arial', sans-serif;}
</style>
<?php
$id = $_POST['ids'];
$user="root";
$password="";
$dbh = new PDO("mysql:host=localhost;dbname=muzicmap", $user, $password);
$sql = " SELECT * FROM  `artist` g WHERE g.id= $id ";
$result = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row){
	    $name=$row['name'];
	    $location= $row['location'];
	    $genre= $row['genre'];
	    $website = $row['website'];
	    
}
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://w.soundcloud.com/player/api.js" type="text/javascript"></script>
<script src="http://connect.soundcloud.com/sdk.js"></script>
<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
<script src="auth.js"></script>
<script>

SC.initialize({
  client_id: 'bd823f5df3df027fa1ef8f664fd9cf01'
});

(function(){
		
		SC.get('/tracks', { q: <?php echo "'{$name}'" ;?> }, function(tracks) {
	  	console.log(tracks);
	  if (tracks.length > 5 ){
	  for(var i = 0 ; i < 5 ;i++){
	  		createIframe(tracks[i]['uri']);
	 }
	 } else {
	 	for(var i = 0 ; i < tracks.length ;i++){
	  		createIframe(tracks[i]['uri']);
	 	}
	 }
	});	
}());

function createIframe(link){
    SC.oEmbed(link, {auto_play: false}, function(oembed){
    $('#soundcloud-container').append(oembed['html']);
  });
}

googleApiClientReady = function() {
	
  gapi.auth.init(function() {
    window.setTimeout(loadAPIClientInterfaces, 1);
  });
}


function loadAPIClientInterfaces() {
  gapi.client.load('youtube', 'v3', searchData);
}


function searchData() {
  var qval=<?php echo "'{$name}'" ;?>	;
  var request = gapi.client.youtube.search.list({
  	 key	: "AIzaSyBmL2qQ75Gar-Tm7Y0D_l5xtI8ekdOdKbE",
    q		: qval,
    part	: 'snippet',
    maxResults : 5
  });
  request.execute(function(response) {
  		console.log(response);
		for(var i = 0; i < response['items'].length;i++){			
			console.log(response['items'][i]['id']['videoId']);
			var newDiv = document.createElement('div');
			var prev = document.getElementById('player');
		  	prev.appendChild(newDiv);
    		onYouTubeIframeAPIReady(response['items'][i]['id']['videoId'],newDiv);
   	}
  });
}

var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
function onYouTubeIframeAPIReady(vid,newDiv) {
		  if (typeof vid != 'undefined'){
        player = new YT.Player(newDiv, {
          height: '390',
          width: '642',
          videoId : vid
        });
        } else {
			console.log(vid); 		
 		}       	
}
</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
</head>
<body>
<a href="testmusic.html" style="text-decoration:none"><h1>Muzic Maps</h1></a>
  <h2><h2>Find Your Music on the Map</h2></h2>
<table align = "center">
<tr><td>Name</td><td><div id="name"><?php echo $name;?></div></td></tr>
<tr><td>Location</td><td><div id="location"><?php echo $location;?></div> </td></tr>
<tr><td>Genre</td><td><div id="genre"><?php echo $genre;?></div></td></tr>
<tr><td>Website</td><td><div id="genre"><a  style="text-decoration:none" target = "_blank" href= <?php echo str_replace("URL","",$website);?> > Click Here To Go To Artists Page </a></div></td></tr>
</table>


<table align = "center" style="width:100%;:horizontal-align:middle; "><tr> <td style="width:50%"><div id="soundcloud-container" style="width:100%;horizontal-align:middle;">
 	
 </div></td><td style="width:50%:horizontal-align:middle;"><div style="width:100%;horizontal-align:middle;"><div id="player" > </div></div></td></tr></table>


 
</body>
</html>
