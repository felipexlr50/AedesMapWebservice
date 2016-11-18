<?php
include "APIKEY_VERIFY.php";
$mysqli = mysqli_connect("localhost", "u517046934_fel", "7c7fd8486","u517046934_aedes");

       $id = (int) $_GET['id']
         
       $sql = "select * from imagem where status = 'F' and id = $id";
       $result = $mysqli->query($sql);
       $resultArray =array();
    
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
           $imagem_id = $row['id'];
           $imagemBlob = $row['imageBlob'];
          
            $resultArray[] = array( 'id' => $imagem_id,'imageBlob' => $imagemBlob); 
        }
    
        $json = array("status" => true, "data" => $resultArray);
 
       @mysqli_close($mysqli);

   header('Access-Control-Allow-Origin: *');
   header('Content-type: application/json');
   echo json_encode($json);
