<?php
include "APIKEY_VERIFY.php";
$mysqli = mysqli_connect("localhost", "u517046934_fel", "7c7fd8486","u517046934_aedes");

      
       $sql = "select * from verificar";
       $result = $mysqli->query($sql);
       $resultArray =array();
    
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $id = $row['id_verificar'];
            $idAdmin = $row['idAdmin'];
            $idImagem = $row['idImagem'];
            $datahora = $row['datahora'];
            
            $resultArray[] = array( 'id' => $id, 'idAdmin'=> $idAdmin,'idImagem'=> $idImagem,'datahora' => $datahora); 
        }
    
        $json = array("status" => true, "data" => $resultArray);
 
       @mysqli_close($mysqli);

   header('Access-Control-Allow-Origin: *');
   header('Content-type: application/json');
   echo json_encode($json);