<?php


$mongo = new MongoDB\Driver\Manager();
$res_obj;  

if($_SERVER["REQUEST_METHOD"] == "PUT"){
    $body = file_get_contents('php://input');
    $data = json_decode($body);
   
}
echo json_encode($res_obj);
?>


