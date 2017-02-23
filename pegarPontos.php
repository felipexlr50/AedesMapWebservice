<?php
include "APIKEY_VERIFY.php";
include "msqliConnection.php";

      
       $sql = "select * from imagem where status = 'F' ";
       $result = $mysqli->query($sql);
       $resultArray =array();
    
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            $dataInserida = $row['dataInserida'];
            $imagemBlob = $row['imageBlob'];
            $imagem_id = $row['id'];
            
            $resultArray[] = array( 'id' => $imagem_id, 'latitude'=> $latitude,'longitude'=> $longitude,'datahora' => $dataInserida); 
        }
    
        $json = array("status" => true, "data" => $resultArray);
 
       mysqli_close($mysqli);

   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json; charset=utf-8');
   echo json_encode($json);

 
    
   
