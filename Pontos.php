<?php
include "APIKEY_VERIFY.php";
include "msqliConnection.php";
if($_SERVER['REQUEST_METHOD'] == "GET"){



      
       $sql = "select imageBlob, latitude,longitude, dataInserida from imagem WHERE status = 'T' ;";
       $result = $mysqli->query($sql);
       $resultArray =array();
    
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            $dataInserida = $row['dataInserida'];
            $resultArray[] = array('latitude'=> $latitude,'longitude'=> $longitude,'datahora' => $dataInserida ); 
        }
    
        $json = array("status" => true, "data" => $resultArray);
 
       @mysqli_close($mysqli);
}else{
	$json = array("status" => false, "msg" => "Request method not accepted!");
}
   header('Access-Control-Allow-Origin: *');
   header('Content-type: application/json');
   echo json_encode($json);
