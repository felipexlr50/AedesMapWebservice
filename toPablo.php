<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
  
  $url = $_POST['url'];
  
  $json = file_get_contents(url);
  header('Access-Control-Allow-Origin: *');
   header('Content-type: application/json');
  
  echo $json;
}
else{
  echo "essa url não funciona!";
}

?>