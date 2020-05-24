<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'conn.php';

    if(isset($_POST['login'])){
        
        $login = $_POST['login'];
        $sql_email = "SELECT email FROM logindata WHERE idUser='$login'";
        $email_res = $connect->query($sql_email);
        if($email_res->num_rows>0){
            $row = $email_res->fetch_assoc();
            $emailTo = $row['email'];
        }
        
        $code = uniqid(true);
        $sql = "INSERT INTO reset_passwords(code, email) VALUES ('$code', '$emailTo')";
        $result = $connect->query($sql);
        if(!$result){
            exit("Error");
        }

        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '**********************';                     // SMTP username
            $mail->Password   = '***********';                                // SMTP password
            $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('testtest05516@gmail.com', 'Eschool');
            $mail->addAddress($emailTo);     // Add a recipient          // Name is optional
            $mail->addReplyTo('no-reply@56lo.warszawa.com', 'No reply');
    
        
            // Content
            $url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/resetPassword.php?code=$code";
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Prosba o zresetowanie hasla';
            $mail->Body    = "<h3>Poprosiłeś o zresetowanie hasła</h3> 
                                Kliknij <a href='$url'>ten link</a> żeby zresetować hasło<br>
                                Jeśli nie prosiłeś o zmianę hasła, zignoruj tę wiadomość<br><br>
                                Pozdrawiamy<br>
                                Zespół Eschool<br>
                                testtest05516@gmail.com";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo '<div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -40%); font-size:22px;"><p style="text-align:center;">Wiadomość została wysłana na email<br/> Sprawdź swoją skrzynkę pocztową.</p>
            </div>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        exit();
    }
    // Instantiation and passing `true` enables exceptions
   




?>
<head>
    <link rel="stylesheet" href="styles/style.css" type="text/css"/>
</head>
<div class="begin-panel">
    <form method="POST">
        <h4 class="headerb">Zmiana hasła</h4>
        <p class="textb">Wpisz swój login. Otrzymasz wiadomość na adres email wpisany w konfiguracji początkowej.</br/>
        W treści wiadomości znajduje się link pozwalający zmienić hasło na nowe, wybrane przez Ciebie.</p>
        <div class="justify">
            <input type="text" name="login" placeholder="Login" autocomplete="off">
            <input type="submit" name="submit" value="Reset hasła" style="margin-left:10px;">
        </div>
    </form>
</div>
