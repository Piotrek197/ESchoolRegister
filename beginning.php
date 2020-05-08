<?php
    session_start();
    // if(isset($_SESSION['errormessage']))
    //     unset($_SESSION['errormessage']);
?>
<head>
    <link rel="stylesheet" href="styles/style.css" type="text/css"/>
</head>

<div class="begin-panel">
    <div class="headerb">
        <div class="content">
        <h4>Konfiguracja początkowa</h4>
    </div>
    <p class="textb">Wygląda na to że logujesz się pierwszy raz. Stwórz własne hasło, które będzie potrzebne do logowania. Wpisz swój email dzięki któremu będziesz mógł odzyskać swoje konto w razie gdybyś zapomniał hasła. Adres email przydatny będzie również do informowania Cię o zmianach w dzienniku jeśli włączysz taką opcję.</p>
    <form method="POST">
        <div class="inputb">
            Ustaw hasło: <input type="password" name="password-beginner" id="passb">
        </div>
        <div class="inputb">
            Wpisz email: <input type="text" name="email-beginner" autocomplete="off" id="emailb">
        </div>
        <div class="justify">
            <progress max="10" value="0" id="strength" style="width:230px;"></progress>
        </div>
        <div id="message-beginner" class="justify"></div>
        <div class="justify">
            <input type="submit" name="submit-beginner" value="Dalej!" class="btnb">
        </div>
    </form>
    <?php
    if(isset($_SESSION['errormessage']))
        echo "<p style='text-align:center; color:red; padding:20px;'>".$_SESSION['errormessage']."</p>";
    ?>
    </div> <!-- content -->
</div>
<script type="text/javascript" src="js/main.js"></script>

<?php
//session_start();
require_once "conn.php";

if(isset($_POST['submit-beginner'])){
    $id_user = $_SESSION['id_user'];
    $pass = $_POST['password-beginner'];
    $email = $_POST['email-beginner'];
    if((isset($_POST['password-beginner'])) && (checkEmail($email))){
        $query = "UPDATE logindata SET pwd='$pass', email='$email' WHERE idUser='$id_user'";
        $result_query = $connect->query($query);
        if($id_user <= 100){
            header('Location: admin.php');
        }else if($id_user > 100 && $id_user <= 500){
            header('Location: teacher/nauczyciel.php');
        }else if($id_user > 500){
            header('Location: student/uczen.php');
        }
    } else {
            $_SESSION['errormessage'] = "Coś poszło nie tak! Puste miejsca, gdzie należy wpisać dane lub email nie jest wpisany prawidłwo";
            exit(); //cos poszło nie tak
        }

    // }else
    //     echo "Hasło powinno mieć co najmniej 8 znaków a także zawierać wielkie i małe litery oraz liczby.<br/>";

    // $email = $_POST['email-beginner'];
    // if(checkEmail($email)){
    //     echo $email;
    // }else{   
    //     echo "To nie jest email.";
    // }

    // function checkPassword($text){
    //     $uppercase = preg_match('@[A-Z]@', $text);
    //     $lowercase = preg_match('@[a-z]@', $text);
    //     $number    = preg_match('@[0-9]@', $text);

    //     if($uppercase && $lowercase && $number){
    //         return true;
    //     }else
    //         return false;
    // }

}


function checkEmail($text){
    if(preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,5}$/', $text))
        return true;
    else
        return false;

}

?>