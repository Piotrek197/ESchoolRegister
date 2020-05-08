<?php
    session_start();
    require_once "conn.php";

    if($connect->connect_errno!=0){
        echo "Error: ".$connect->connect_errno;
    }else {
        $userIndex = $_POST['userIndex'];
        $password = $_POST['pwd'];


        $sql = "SELECT * FROM logindata WHERE idUser='$userIndex' AND pwd='$password'";


        if($result = $connect->query($sql)){       /*sprawdza czy nie ma literówki*/

            if($result->num_rows>0){
                $row = $result->fetch_assoc();
                $_SESSION['id_user'] = $row['idUser'];
                $email = $row['email'];

                if($email!=null){
                    unset($_SESSION['blad']);
                    $result->close();

                    if($_SESSION['id_user'] <= 100){
                        header('Location: admin.php');
                    }else if($_SESSION['id_user'] > 100 && $_SESSION['id_user'] <= 500){
                        header('Location: teacher/nauczyciel.php');
                    }else if($_SESSION['id_user'] > 500){
                        header('Location: student/uczen.php');
                    }
                }else{
                    header('Location:beginning.php');
                }

                 
                

                //echo $user;
            } else {
                $_SESSION['blad'] = '<span style="color:red;">Nieprawidłowy login lub hasło </span>';
                header('Location: index.php');
            }
        
        } 
        
        

        $connect->close();
    }





?>