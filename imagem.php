<?php
include "APIKEY_VERIFY.php";
$mysqli = mysqli_connect("localhost", "u517046934_fel", "7c7fd8486","u517046934_aedes");

      if($_SERVER['REQUEST_METHOD'] == "POST"){
        
       
       $id = intval($_POST['id']); 
       $sql = "select * from imagem where status = 'F' and id = $id";
       $result = $mysqli->query($sql);
       $error = $mysqli->error;
       $resultArray =array();
       if($result){ 
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
           $imagem_id = $row['id'];
           $imagemBlob = $row['imageBlob'];
        }
          $json = array("status" => true, 'id' => $imagem_id,'imageBlob' => $imagemBlob);
       }else{
         $json = array("status" => false, "msg" => $error);
       }
        
      }else{
	      $json = array("status" => false, "msg" => "Request method not accepted!");
    }
         
      

       
 
       @mysqli_close($mysqli);

   header('Access-Control-Allow-Origin: *');
   header('Content-type: application/json');
   echo json_encode($json);
