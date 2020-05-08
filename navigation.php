
<head>
    <link rel="stylesheet" href="../styles/navbar.css" type="text/css"/>
</head>
<?php

echo "
<nav>
    <div class='left'>";
    if($_SESSION['id_user'] > 100 && $_SESSION['id_user'] <= 500){
        echo "<p><a href='nauczyciel.php'>Panel nauczyciela</a></p>
        <p><a href='teacher_settings.php'>Ustawienia</a></p>";
    }else
        echo "<p><a href='uczen.php'>Oceny</a></p>
        <p><a href='student_settings.php'>Ustawienia</a></p>";

echo      "
    </div>
    <div class='right'>
        <p><a href='../logout.php'>Wyloguj się</a></p>
        
        

    </div>
</nav>
    ";

?>