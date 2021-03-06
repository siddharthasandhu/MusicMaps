<?php

$username="root";
$password="";
$database="muzicmap";

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query =  "SELECT DISTINCT (
                `name`
                ) AS `name` , `id` , `location` , `background` , `genre` , `current_members` , `website` , `image` , `lonlat`
                FROM `artist`
                WHERE `location` LIKE '%Los Angeles%'
                LIMIT 10 
                ";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("location", $row['address']);
  $newnode->setAttribute("id", $row['id']);
  $newnode->setAttribute("background", $row['background']);
  $newnode->setAttribute("genre", $row['genre']);
  $newnode->setAttribute("website",$row['website']);
  $newnode->setAttribute("image", $row['image']);
  $newnode->setAttribute("current_members", $row['current_members']);
}

echo $dom->saveXML();

?>
