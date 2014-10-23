<?php
    	$ids = $_POST['ids']; 
		$user="root";
		$password="Getsuga@123";
		$dbh = new PDO("mysql:host=localhost;dbname=muzicmap", $user, $password);
		$query=" SELECT  `genre`.id AS id,  `genre`.name AS name, SUM(  `genreartistmap`.val ) AS Val
					FROM  `genreartistmap` 
					LEFT JOIN  `genre` ON genre.id = genreartistmap.genreid
					WHERE  `genreartistmap`.artistid
					IN ( $ids ) 
					GROUP BY genre.name ";
		$result = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		echo $query;	
		echo $ids;
	?>