<?php
include "APIKEY_VERIFY.php";
include "msqliConnection.php";


     if($_SERVER['REQUEST_METHOD'] == "POST"){
			 
			 $id = $_POST['id'];
			 
			 $sql = "select * from imagem where status = 'F' and id = $id ";
			 $result = $mysqli->query($sql);
       $resultArray =array();
			 $imagemBlob = "";
			 $imagem_id = "" ;
			 if($result){
				  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $imagemBlob = $row['imageBlob'];
            $imagem_id = $row['id'];
            
           // $resultArray[] = array(); 
        }
    
       // $json = array("status" => true, "data" => $resultArray);
				 $json = array("status" => true, 'id' => $imagem_id, 'imageBlob' => $imagemBlob);
			 }
			 else{
					$json = array("status" => false, "msg" => "Algo deu errado :( ");
			 }
			 
			 
			 
		 } 
		 else{
			$json = array("status" => false, "msg" => "Request method not accepted!");
		}	



   header('Access-Control-Allow-Origin: *');
   header('Content-type: application/json');
   echo json_encode($json);
