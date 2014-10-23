<html>
  <head>
 <LINK href="table.css" rel="stylesheet" type="text/css">
  <style type="text/css">
body {background-image:url("love-and-music1.jpg");
		font-family: 'Helvetica', 'Arial', sans-serif;}
		.center
{
margin:auto;
width:70%;
}
</style>
    <?php 
	$ids = $_POST['ids'];
	$genre = $_POST['genre'];
	$user="root";
	$password="Getsuga@123";
	$dbh = new PDO("mysql:host=localhost;dbname=muzicmap", $user, $password);
	$sql = " SELECT g.id as id, g . name as name , g.genre as genre, g.location as location , g.image as image
				FROM  `artist` g
				LEFT JOIN  `genreartistmap` gm ON gm.artistid = g.id
				WHERE gm.artistid
				IN ( {$ids} ) 
				AND gm.genreid = {$genre}";
	try {
		$result = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
	    $return[]=array('id' => $row['id'],'name'=>$row['name'],'location'=> $row['location'],'genre'=> $row['genre']);
	
		}
	} catch (Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script> 
<script type="text/javascript">

var table = document.getElementById("musicians");
var result=[];
<?php foreach($return as $arr){ ?> ;
			result.push(<?php echo "[ '{$arr['name']}', '{$arr['location']}' ,'{$arr['genre']}' ,{$arr['id']} ]";?>);
    	<?php	}?>;

window.onload =function(){ 
for(var i= 0; i<result.length;i++){
	$('#musicians').append('<tr id = \"'+ result[i][3] +'\" name = "'+result[i][2]+'"><td>'+ result[i][0] + '</td><td>' + result[i][1] + '</td><td>' + result[i][2] + '</td></tr>');
	jQuery(document.getElementById('musicians').getElementsByTagName('tr')).click(function(event) {
          
            $('#idpass').val(this.id);
 				$('#formSubmit').submit();
        });
};	

}

</script>
  </head>
<body>
<a href="testmusic.html" style="text-decoration:none"><h1>Muzic Maps</h1></a>
  <h2><h2>Find Your Music on the Map</h2></h2>
<div class="center">
<div class="CSSTableGenerator" style="width:600px;height:150px;">
<table id="musicians">
	<tr><td>Name</td><td>Location</td><td>Genre</td></tr>
</table>
</div>
</div>
<form method="post" action="finalPage.php" id="formSubmit"><input id="idpass" type="hidden" name="ids"/><input id="location" type="hidden" name="location"/></form>
</body>

</html>