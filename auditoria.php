<?php
include "APIKEY_VERIFY.php";
include "msqliConnection.php";


      
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
   header('Content-Type: application/json; charset=utf-8');
   echo json_encode($json);
