<?php
$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
$mysqli->real_connect("us-east.connect.psdb.cloud", "0ffl3bw7ntx7yjm636va", "pscale_pw_Evz9uLY7C0T9AhMoc3Vfr48wKLMB4JtbvqSKCOZBe2X", "guvi_task");
// $mongo = new MongoDB\Driver\Manager("mongodb+srv://sarankumar:Sarankumar@guvi.wqix3ss.mongodb.net/?retryWrites=true&w=majority");
// var_dump($mongo);
// $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
$res_obj;  

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $body = file_get_contents('php://input');
    $data = json_decode($body);
    $result = $mysqli->query("INSERT INTO USERS(ID, EMAIL, FIRSTNAME, LASTNAME, DOB, PASSWORD) VALUES(UUID_TO_BIN(UUID()), '".$data->email."', '".$data->firstname."', '".$data->lastname."', '".$data->dateofbirth."', '".$data->password."')");
    if($result === TRUE){
        $result = $mysqli->query("SELECT BIN_TO_UUID(ID) AS ID FROM USERS WHERE EMAIL='".$data->email."'");
         if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            // $cursor = new MongoDB\Driver\BulkWrite();
            // $cursor->insert(["_id"=> $row["ID"], "email"=>$data->email, "firstname"=>$data->firstname, "lastname"=>$data->lastname, "dob"=>$data->dateofbirth]);
            $res = array("success"=>true, "data" => array("email"=>$data->email, "id"=>$row["ID"]));
            // $result = $mongo->executeBulkWrite('guvi.users', $cursor);
            echo $result;
            $res_obj = $res;
        }
      } else {
        $res = array("success"=>false, "data"=>NULL);
        $res_obj = $res;
    }
    }else{
        $res = array("success"=>false, "data"=>NULL);
        $res_obj = $res;
    }
   
}
echo json_encode($res_obj);
?>


