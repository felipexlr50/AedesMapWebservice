<?php

$mysqli = mysqli_connect("localhost", "u517046934_fel", "7c7fd8486","u517046934_aedes");
 
    
    $sql = "select latitude,longitude, dataInserida from imagem ";
    $result = $mysqli->query($sql); //mysqli_query($mysqli,$sql);
    // printf("Error: %s\n", mysqli_error($mysqli));
    $resultArray =array();
    
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $imageString = $row['imgageBlob']
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
        $dataInserida = $row['dataInserida'];
       // $resultArray[] = array("{latitude : $latitude","longitude : $longitude","datahora : $dataInserida}" );
       $resultArray[] = array('latitude'=> $latitude,'longitude'=> $longitude,'datahora' => $dataInserida, 'imgString' => $imageString ); 
    }
    
    $json = array("status" => 1, "info" => $resultArray);
 
 @mysqli_close($mysqli);
 
 /* Output header */
 header('Content-type: application/json');
 echo json_encode($json);