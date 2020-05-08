<head>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<?php
session_start();
include('../navigation.php');
$_SESSION['class'] = $_GET['class'];
$class= $_SESSION['class'];

$_SESSION['subject'] = $_GET['subject'];
$subject = $_SESSION['subject'];


echo "<div class='begin-panel'>
        <div class='center-all'>
            <h4>Wybrałeś klasę ".$class." - przedmiot ".$subject."</h4>
            <div>
                <a href='class.php?class=".$class."&subject=".$subject."'>Pokaż oceny</a>
                <a href='addGrade.php?class=".$class."&subject=".$subject."'>Dodaj oceny</a>
            </div>
        </div>
    </div>";
?>

<style>
.begin-panel {
    height:150px;
}

h4{
    padding-top:20px;
}

</style>








