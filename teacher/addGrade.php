<head>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<?php
session_start();
require_once "../conn.php";
include('../navigation.php');

$class = $_GET['class'];
$subject = $_GET['subject'];

$sql = "SELECT s.name, s.lastname, s.id_student FROM student s WHERE S.fk_id_class='$class';";

$res = $connect->query($sql);

$students = [];
$ids = [];
if($res->num_rows>0){
    while($row = $res->fetch_assoc()){
        $students[] = $row['name']." ".$row['lastname'];
        $ids[] = $row['id_student'];
    }

}


date_default_timezone_set('Europe/Warsaw');

$info = getdate();
$day = $info['mday'];
$month = $info['mon'];
$year = $info['year'];

$date = "$year-$month-$day";

if(isset($_POST['submitbtnadd'])){

    $grade_array = isset($_POST['grade']) ? $_POST['grade'] : array();
    $weight_array = isset($_POST['weight']) ? $_POST['weight'] : array();
    $type_array = isset($_POST['type']) ? $_POST['type'] : array();

    $total_rows = count($grade_array);

    if($total_rows > 0){
        for($i = 0; $i<$total_rows; $i++){ //iteruje po wszystkich inputach czyli wszystkich uczniach 
            $selectedStudent = $ids[$i]; //501 502 503 ... 512 dla 1a
            $grade = $grade_array[$i]; //jeśli nie ma oceny to $grade = 0
            $weight = $weight_array[$i];
            $type = $type_array[$i];
            if($grade>0 && $grade<7){ //przepuszcza tylko tych co mają ocenę w inputach i dodaje
                $sql_add_grade = "INSERT INTO `grades`(`fk_id_student`, `fk_id_subject`, `grade`, `date_of_issue`, `type`, `weight`) VALUES 
                ('$selectedStudent','$subject','$grade','$date','$type','$weight')";
                $res = $connect->query($sql_add_grade);
            }
        }
    }

        
   
}


?>
<style>
table, th, td {
    border: 1px solid #444;
    border-collapse: collapse; 
}

th, td{
    padding:0;
    margin:0;
    width:22%;
    height:35px;
}

table{
    width:100%;
}
#panel{
    width:40%;
}
.student-column-add-grade{
    width:34%;
}

input, select{
    width:100%; 
    height:100%;
    box-sizing:border-box;
}

option{
    height:35px;
}

</style>

<div class='grades-panel' id="panel">
<h3 style="text-align:center;">Dodaj oceny z <?php echo $subject; ?></h3>
<p class="invisible" id="number_of_students"><?php echo count($ids)?></p>
<form  id="addGradeForm" method='post'>
<table id='tableaddgrade'>
    

    <tr>
        <th>Uczeń</th>
        <th>Ocena</th>
        <th>Waga</th>
        <th>Rodzaj</th> 
    </tr>
    
    <tr>
        <td>Wszyscy</td>
        <td><input type='number' id='grade_up' name='grade' min='1' max='6'></td>
        <td>
            <select id='weights_up' name='weight'>
                <option>1</option>
                <option>1.5</option>
                <option>0.75</option>
                <option>0.5</option>
                <option>1.75</option>
                <option>0.25</option>
                <option>1.3</option>
                <option>0.9</option>
            </select>
        </td>
        <td>
            <select id='types_up' name='type'>
                <option>Sprawdzian</option>
                <option>Kartkówka</option>
                <option>Praca domowa</option>
                <option>Praca klasowa</option>
                <option>Projekt</option>
                <option>Aktywność</option>
                <option>Test</option>
                <option>Inne</option>
            </select>
        </td>
    
    </tr>
<?php

for($i = 0; $i<count($ids); $i++){

echo "<tr><td class='student-column-add-grade' name='sstudent[".$i."]'>".$students[$i]."</td>
    <td><input type='number' id='grade-class".($i+1)."' name='grade[".$i."]' min='1' max='6'></td>
    <td><select id='weight".($i+1)."' name='weight[".$i."]'>
        <option>1</option>
        <option>1.5</option>
        <option>0.75</option>
        <option>0.5</option>
        <option>1.75</option>
        <option>0.25</option>
        <option>1.3</option>
        <option>0.9</option>
    </select></td>

    <td><select id='type".($i+1)."' name='type[".$i."]'>
        <option>Sprawdzian</option>
        <option>Kartkówka</option>
        <option>Praca domowa</option>
        <option>Praca klasowa</option>
        <option>Projekt</option>
        <option>Aktywność</option>
        <option>Test</option>
        <option>Inne</option>
    </select></td></tr>";
} //for loop
?>
</table>

    <input class="btnadd" type='submit' value='Dodaj oceny' name='submitbtnadd' id="submitadd" >

    </form>
</div>
<script src="../js/addGrade.js"></script>