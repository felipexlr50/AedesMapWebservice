<?php

function curl_get_contents($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
  
  $url = $_POST['url'];
  
 $json = curl_get_contents($url);
	 header('Access-Control-Allow-Origin: *');
     header('Content-type: application/json');
  
  echo $json;
}
else{
  echo "essa url não funciona!";
}

?>