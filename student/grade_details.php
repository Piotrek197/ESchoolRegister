<head>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<?php
session_start();
require_once "../conn.php";
include('../navigation.php');


$id_grade = $_GET['id_grade'];

$res = $connect->query("SELECT * 
                        FROM grades g 
                        JOIN subject sb ON g.fk_id_subject = sb.id_subject
                        JOIN teacher t ON sb.fk_id_teacher = t.id_teacher 
                        WHERE g.id_grade = '$id_grade'");

if($res->num_rows >0){
    $row = $res->fetch_assoc();
    $grade = $row['grade'];
    $subject = $row['subject_name'];
    $type = $row['type'];
    $weight = $row['weight'];
    $teacher = $row['teacher_name']." ".$row['teacher_lastname'];
    $date = $row['date_of_issue'];

}

//echo "Masz ".$grade." z ".$subject.".";

$data_parts = explode("-", $date);
$months = array( 1 => "stycznia", 2 => "lutego", 3 =>"marca", 4 =>"kwietnia", 5 => "maja", 6=>"czerwca", 7=>"lipca", 8=>"sierpnia", 
                9=>"września", 10=>"października", 11=>"listopada", 12=>"grudnia");


?> 

<div class="details-panel">
    <table>
        <tr>
            <th colspan="2" style="align-center">Ocena z <?php echo $subject;?></th>
        </tr>
        <tr>
            <td>Ocena</td>
            <td><?php echo $grade;?></td>
        </tr>
        <tr>
            <td>Za co</td>
            <td><?php echo $type ?></td>
        </tr>
        <tr>
            <td>Temat</td>
            <td></td>
        </tr>
        <tr>
            <td>Waga</td>
            <td><?php echo $weight;?></td>
        </tr>
        <tr>
            <td>Dodana przez</td>
            <td><?php echo $teacher;?></td>
        </tr>
        <tr>
            <td>Data dodania</td>
            <td>
                <?php echo $data_parts[2]." ";
                    if(substr($data_parts[1], 0,1)==0) 
                    echo $months[substr($data_parts[1], 1)];
                    else 
                    echo $months[$data_parts[1]];
                    echo " ".$data_parts[0];
                ?>
            </td>
        </tr>
        <tr>
            <td>Komentarz</td>
            <td></td>
        </tr>
    </table>
</div>