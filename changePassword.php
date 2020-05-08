<?php

$id_user = $_SESSION['id_user'];

if(isset($_POST['np_submit'])){

$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];
$repPassword = $_POST['repeat_password'];
$errorMessage;

// echo $oldPassword."<br/>";
// echo $newPassword."<br/>";
// echo $repPassword."<br/>";
// echo $id_user;


$sql_password = "SELECT l.pwd FROM logindata l WHERE idUser = '$id_user';";
$result = $connect->query($sql_password);
if($result->num_rows>0){
    $row = $result->fetch_assoc();  
    $passwordFromDB = $row['pwd'];
}

if($oldPassword == $passwordFromDB){
    //$errorMessage = "<br/>Możesz przejść towarzyszu";
    if(($newPassword!=null) && ($newPassword == $repPassword)){
        $errorMessage = "<span style='color:green;'><p style='text-align:center;'>Twoje hasło zostało zmienione.</p></span>";
        $res = $connect->query("UPDATE logindata SET pwd='$newPassword' WHERE idUser = '$id_user';");
    }else
    $errorMessage = "<span style='color:red;'><p style='text-align:center;'>Hola hola wpisałeś dwa różne hasła, albo nie uzupełniłeś czegoś, Popraw się!</p></span>";
}else
    $errorMessage = "<span style='color:red;'><p style='text-align:center;'>Hola hola kolego/koleżanko!<br>  Wpisałeś/aś złe dane albo nie wpisałeś/aś wcale!</p></span>";


}
//exit("gra");




?>
<style>
    #panel{
    border:2px solid #345abc;
    width:30%;
    position:absolute;

    left:35%;

    }

    h4 {
        text-align:center;
    }
    form{
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
    }

    .btn{
        margin-bottom:10px;
    }
</style>
<div id="panel">
<h3 style="text-align:center; margin:20px 0; font-size:25px">Ustawienia</h3>
<form method="POST">

Stare hasło: <input type="password" name="old_password"><br/>
Nowe hasło: <input type="password" name="new_password"><br/>
Powtórz hasło: <input type="password" name="repeat_password"><br/>

<input type="submit" name="np_submit" value="Zmień hasło" class="btn"> 
</form>
<?php
if (isset($errorMessage))
    echo $errorMessage;
?> 
</div>