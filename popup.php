<?php
header('Access-Control-Allow-Origin: *');
   require_once 'connection.php';
    $sql="SELECT * FROM annotation";
    $result = mysqli_query($conn,$sql);
    $data = array();
    foreach($result as $row) {
        $data[] = $row;
    }
    mysqli_free_result($result);
    
     echo json_encode($data);
   



?>


