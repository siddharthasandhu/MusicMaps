<html>
  <head>
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
	$user="root";
	$password="Getsuga@123";
	$dbh = new PDO("mysql:host=localhost;dbname=muzicmap", $user, $password);
	$sql = " SELECT  `genre`.id AS id,  `genre`.name AS name, SUM(  `genreartistmap`.val ) AS Val
						FROM  `genreartistmap` 
						LEFT JOIN  `genre` ON genre.id = genreartistmap.genreid
						WHERE  `genreartistmap`.artistid
						IN ( $ids ) 
						GROUP BY genre.name ";

	try {
		$result = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
	    $return[]=array('id' => $row['id'],'name'=>$row['name'],'Val'=> $row['Val']);
	
		}
	} catch (Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
    <script type="text/javascript">
    	var ids = <?php echo "'{$ids}'";?>;
    	console.log(ids);
    	var result = [['Genre','Total Musicians','Genre ID']];
		<?php foreach($return as $arr){ ?> ;
			result.push(<?php echo "[ '{$arr['name']}', {$arr['Val']} ,{$arr['id']} ]";?>);
    	<?php	}?>;
    	console.log(result);    	
      google.load("visualization", "1", {packages:["corechart"]});
      
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable(result);

        var options = {
          title: 'Genre/Number of Musicians'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        google.visualization.events.addListener(chart, 'select',function(){
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var genre = data.getValue(selectedItem.row, 2);
            $('#idpass').val(ids);
            $('#genre').val(genre);
 				$('#formSubmit').submit();
          };
        });
  
      }
    </script>
   <a href="testmusic.html" style="text-decoration:none"><h1 >Muzic Maps</h1></a>
  <h2><h2>Find Your Music on the Map</h2></h2>
  </head>
  <body>
  <div class="center">
  	 <table align= "center"><tr>
    <div id="piechart" style="width: 900px; height: 500px;" align= "center" ></div></tr></table>
    <form method="post" action="musicians.php" id="formSubmit"><input id="idpass" type="hidden" name="ids"/><input id="genre" type="hidden" name="genre"/></form>
  
  </div></body>
</html>
