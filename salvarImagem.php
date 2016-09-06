<?php

include "APIKEY_VERIFY.php";

//$mysqli = mysqli_connect("localhost", "root", "","aedesmap");
$mysqli = mysqli_connect("localhost", "u517046934_fel", "7c7fd8486","u517046934_aedes");

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$password = "batata";
	$APIKEY = $_SERVER['HTTP_X_API_KEY'];
	list($token,$timestamp) = explode("-",$APIKEY);
	$hash = hash("sha256",$password . $timestamp);

	if($hash==$token && testTimeStamp($timestamp,600)){

			// Get data
			//$imageBlob = mysqli_real_escape_string($mysqli,$_POST['imageBlob']);
			$latitude = floatval($_POST['latitude']);
			$longitude = floatval($_POST['longitude']);
			$imageString = $_POST['imagem'];
			$repairImg = str_replace("\\","",$imageString);
			$repairImg = str_replace("\\n","",$repairImg);
			$imageData = base64_decode($repairImg);
		
			date_default_timezone_set('America/Sao_Paulo');
			$date = date('Y-m-d H:i:s');
			$imgName = str_replace(" ","",$date);
		
			file_put_contents('/img/temp/'.$imgName, $imageData);

			// Insert data into data base
			$sql = "INSERT INTO imagem (latitude, longitude) 
					VALUES ($latitude, $longitude);";
			$qur = $mysqli->query($sql);
			$error = $mysqli->error;
			if($qur){
				$json = array("status" => 1, "msg" => "OK", "base64"=>$imageString);
			}else{
				$json = array("status" => 0, "msg" => $error, "base64"=>$imageString);
			}

	}else {
		$json = array("status" => 0, "msg" => "Api key invalided!","recived"=>$APIKEY,
		"generated" => $hash);
	}
	
	
}

else{
	$json = array("status" => 0, "msg" => "Request method not accepted!");
}

mysqli_close($mysqli);

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);