<?php
include "APIKEY_VERIFY.php";

$mysqli = mysqli_connect("localhost", "u517046934_fel", "7c7fd8486","u517046934_aedes");

if($_SERVER['REQUEST_METHOD'] == "POST"){
  
  
  $password = "batata";
	$APIKEY = $_POST['API_KEY'];
	list($token,$timestamp) = explode("-",$APIKEY);
	$hash = hash("sha256",$password . $timestamp);

	if($hash==$token && testTimeStamp($timestamp,600)){
    $id_admin = $_POST['id_admin'];
		$id_imagem = $_POST['id_imagem'];
			
    $sql = "INSERT INTO verificar (idAdmin, idImagem) VALUES ($id_admin,$id_imagem);";
			$qur = $mysqli->query($sql);
    $sql = "UPDATE imagem SET status = 'T' WHERE id = $id_imagem ;";
			$error = $mysqli->error;
			if($qur){
				$json = array("status" => true, "msg" => "OK");
			}else{
				$json = array("status" => false, "msg" => $error);
			}
			
  }else {
		$json = array("status" => false, "msg" => "Api key invalided!");
	}
  
}else{
	$json = array("status" => false, "msg" => "Request method not accepted!");
}

mysqli_close($mysqli);

/* Output header */
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');
	echo json_encode($json);
?>
