<?php 
$user="root";
$password="";
$dbh = new PDO("mysql:host=localhost;dbname=muzicmap", $user, $password);

$sql = "SELECT DISTINCT (
                `name`
                ) AS `name` , `id` , `location` , `background` , `genre` , `current_members` , `website` , `image` , `lonlat`
                FROM `artist`
                LIMIT 500  
                ";

$result = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//To output as-is json data result
//header('Content-type: application/json');
//echo json_encode($result);

//Or if you need to edit/manipulate the result before output
foreach ($result as $row){
	 $row['location']=preg_replace('/[^(\x20-\x7F)]*/','', $row['location']);
	 $row['location'] = preg_replace('/\s*,\s*/', ',', $row['location']);
    $return[]=array('id' => trim($row['id']),'name'=>trim($row['name']),'location'=> trim($row['location']),'background' => $row['background'], 'genre' => $row['genre'],'current_members'=>$row['current_members'],'website' => $row['website']);
	


}
$dbh = null;

header('Content-type: application/json');
echo json_encode($return);
?>
