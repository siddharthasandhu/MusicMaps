<html>
<body>
<?php

function get_images($query){
    $url = 'http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=';
    //enter your API key here
    $key = 'AIzaSyBmL2qQ75Gar-Tm7Y0D_l5xtI8ekdOdKbE';
    $url .= urlencode($query).'&key='.$key;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    //decoding request
    $result = json_decode($data, true);

    return $result;
}

$images = get_images("cars");

echo "<pre>";
print_r($images);
echo "</pre>";


?>
</body>
</html>