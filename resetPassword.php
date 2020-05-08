<?php

include("conn.php");

if(!isset($_GET['code'])){
    exit("Can't find page");
}

$code = $_GET['code'];
$getEmailQuery = "SELECT email FROM reset_passwords WHERE code = '$code'";
$result = $connect->query($getEmailQuery);
if($result->num_rows==0){
    exit("Can't find page");
}



if(isset($_POST['password'])){
    $password = $_POST['password'];
    $row = $result->fetch_assoc();
    $email = $row['email'];

    $query = "UPDATE logindata SET pwd='$password' WHERE email='$email'";
    $result_query = $connect->query($query);
    if($query){
        $query2 = "DELETE FROM reset_passwords WHERE code = '$code'";
        $res_query = $connect->query($query2);
        exit("Hasło zostało zmienione");
    }
    else {
        exit("Coś poszło nie tak");
    }
}
?>




<form method="POST">
    <input type="password" name="password" placeholder="Hasło">
    <br>
    <input type="submit" name="submit" value="Ustaw hasło">
 
</form>