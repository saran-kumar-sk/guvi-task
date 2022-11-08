<?php

$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
$mysqli->real_connect("us-east.connect.psdb.cloud", "0ffl3bw7ntx7yjm636va", "pscale_pw_Evz9uLY7C0T9AhMoc3Vfr48wKLMB4JtbvqSKCOZBe2X", "guvi_task");
$res_obj;  

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $result = $mysqli->query("SELECT BIN_TO_UUID(ID) AS ID, EMAIL FROM USERS WHERE EMAIL='".$email."' AND PASSWORD='".$password."'");
    if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            $res = array("success"=>true, "data"=>array("email"=>$email, "id"=>$row["ID"]));
            $res_obj = $res;
        }
      } else {
        $res = array("success"=>false, "data"=>NULL);
        $res_obj = $res;
    }
}
echo json_encode($res_obj);
?>


