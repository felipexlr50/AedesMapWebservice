<?php
include "APIKEY_VERIFY.php";
$mysqli = mysqli_connect("localhost", "u517046934_fel", "7c7fd8486","u517046934_aedes");

if($_SERVER['REQUEST_METHOD'] == "GET"){
  $password = "batata";
	$APIKEY = $_SERVER['HTTP_X_API_KEY'];
	list($token,$timestamp) = explode("-",$APIKEY);
	$hash = hash("sha256",$password . $timestamp);

	if($hash==$token && testTimeStamp($timestamp,600)){
      
       $sql = "select imageBlob, latitude,longitude, dataInserida from imagem ";
       $result = $mysqli->query($sql); //mysqli_query($mysqli,$sql);
        // printf("Error: %s\n", mysqli_error($mysqli));
        $resultArray =array();
    
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            $dataInserida = $row['dataInserida'];
           // $resultArray[] = array("{latitude : $latitude","longitude : $longitude","datahora : $dataInserida}" );
           $resultArray[] = array('latitude'=> $latitude,'longitude'=> $longitude,'datahora' => $dataInserida ); 
        }
    
        $json = array("status" => 1, "info" => $resultArray);
 
       @mysqli_close($mysqli);
 
       /* Output header */
       header('Access-Control-Allow-Origin: *');
       header('Content-type: application/json');
       echo json_encode($json);
			

	}else {
		$json = array("status" => 0, "msg" => "Api key invalided!","recived"=>$APIKEY,
		"generated" => $hash);
    	echo json_encode($json);
      echo "<br>";
      echo "Recived: " .$token;
      echo "<br>";
      echo "Expected: " .$hash;
    
	}
}
 
    
   