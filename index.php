<?php
    session_start();
    if((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in']==true)){
        if($_SESSION['id_user'] <= 100){
            header('Location: admin.php');
        }else if($_SESSION['id_user'] > 100 && $_SESSION['id_user'] <= 500){
            header('Location: teacher/nauczyciel.php');
        }else if($_SESSION['id_user'] > 500){
            header('Location: student/uczen.php');
        }
        exit();
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login-panel.css" type="text/css">
    <link rel="stylesheet" href="styles/style.css" type="text/css">
    <link href="fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet"> <!--load all styles -->

    <title>Document</title>
</head>
<body>
    <div class="login-panel">
        <form action="login.php" method="post">
            <h1>Witaj!</h1>
            
                
            <div class="text-input one <?php
                 if(isset($_SESSION['blad'])){echo 'is-invalid';}?>">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Login</h5>
                    <input  type="text" class="input" name="userIndex" autocomplete="off"/>
                </div> 
            </div>
            
            
                
            <div class="text-input two <?php
                 if(isset($_SESSION['blad'])){echo 'is-invalid';}?>">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Hasło</h5>
                    <input type="password" class="input" name="pwd"/>
                </div>
            </div>

            <a href="requestReset.php">Zapomniałeś hasła?</a><br/>
            <?php
                 if (isset($_SESSION['blad'])){
                    echo $_SESSION['blad'];
                    $session_variable = $_SESSION['blad'];
                 }
                
            ?>
            <input type="submit" class="submit-btn" value="Zaloguj"/>
            
        </form>
    </div>


<script type="text/javascript" src="js/main.js"></script>
</body>
</html>