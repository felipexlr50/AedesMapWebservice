<?php
include "APIKEY_VERIFY.php";
include "msqliConnection.php";


if($_SERVER['REQUEST_METHOD'] == "POST"){
  $password = "batata";
	$APIKEY = $_POST['API_KEY'];
	$email = $_POST['email'];
  $senhaClient = $_POST['senha'];
	list($token,$timestamp) = explode("-",$APIKEY);
	$hash = hash("sha256",$password . $timestamp);

	if($hash==$token && testTimeStamp($timestamp,600)){
    
    $sql = "SELECT DISTINCT * FROM admin WHERE email = '$email' ";
       $result = $mysqli->query($sql);
       $error = $mysqli->error;
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $senha = $row['senha'];
            $id_admin = $row['id_admin'];
            $nome = $row['Nome'];
            
    }
		
	    if($senha == $senhaClient){
					$sql = "INSERT INTO login (id_admin) VALUES ($id_admin);";
					$qur = $mysqli->query($sql);
        $json = array("status" => true, "msg" => "Logado", "id" => $id_admin, "nome" => $nome );
				
    }
    else{
			//$debug = array("error"=>$error, "email" => $email, "senha"=>$senhaClient);
		 	//$json = array("status" => false, "msg" => "Logado", "id" => $id_admin, "nome" => $nome ); 
			$json = array("status" => false, "msg" => "Senha ou login errados");
		}
  }
  
  else {
		$json = array("status" => false, "msg" => "Api key invalided!");
	}
}

else{
	$json = array("status" => false, "msg" => "Request method not accepted!");
}

mysqli_close($mysqli);

/* Output header */
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');
	echo json_encode($json);

?>
