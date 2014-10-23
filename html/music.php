<?php
	$user="root";
	$password="Getsuga@123";
	$database="muzicmap";
	$con=mysqli_connect("localhost",$user,$password,$database);
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$query="SELECT DISTINCT (
		`name`
		) AS `name` , `id` , `location` , `background` , `genre` , `current_members` , `website` , `image` , `lonlat`
		FROM `artist`
		WHERE `location` LIKE '%Los Angeles%'
		LIMIT 50 
		";
	$result=mysqli_query($con,$query);
	$formatedResult;
	while($row = mysqli_fetch_array($result)) {
  			echo $row['id'] . "," . $row['name']. "," . $row['location']. "," . $row['background']. "," . $row['genre']. "," . $row['current_members']. "," . $row['website'];
  			echo "<br>";
	}
	mysqli_close();
?>
