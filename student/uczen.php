<?php
    session_start();
    require_once "../conn.php";
    include "Grade.php"; //class Grade
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php
        include('../navigation.php');

        $user_index = $_SESSION['id_user'];

        $sql_student = "SELECT g.grade, g.date_of_issue, s.name, s.lastname, sb.subject_name, s.fk_id_class
        FROM student s 
        JOIN grades g ON s.id_student = g.fk_id_student 
        JOIN subject sb ON g.fk_id_subject = sb.id_subject
        WHERE s.id_student = '$user_index'";
        $result_student = $connect->query($sql_student);

        if($result_student->num_rows>0){
             $_SESSION['logged_in'] = true;
             $row = $result_student->fetch_assoc();
             $_SESSION['student_name'] = $row['name'];
             $lastName = $row['lastname'];
             $grade = $row['grade'];
             $class = $row['fk_id_class'];
            
        echo "<div class='content'><h4> Siema ".$_SESSION['student_name']." ".$lastName."!</h4>";//Masz ".$grade." z Fizy! </p>";
        }
        else
            echo " Nie udało się połączyć.";



    $sql_subjects = "SELECT s.subject_name, s.id_subject
    FROM subject s 
    JOIN subjects_in_classes sic ON s.id_subject = sic.fk_id_subject 
    WHERE sic.fk_id_class = '$class'
    ORDER BY s.subject_name";

   

    $res_sub = $connect->query($sql_subjects);
   
    if($res_sub->num_rows>0){
        $subjects = [];
        while($row = $res_sub->fetch_assoc()){
            $subjects[] = $row['subject_name'];
            $idSubjects[] = $row['id_subject'];
            
        }
       
     
        //$grades[] = grades($user_index, $idSubjects[$i], $connect);
        echo "<div class='grades-panel'>
        <table>
        <tr>
            <th>Przedmiot</th>
            <th>Oceny</th>
            <th>Średnia</th>
            <th>Średnia klasowa</th>
        </tr>";
        $i = 0;
        $gradeo = new Grade;

        foreach($subjects as $subject){

            echo "<tr> 
            <td id='subject-column'>".$subject."</td>";
            echo "<td id='grade-column'>";
            $gradeo->grades($user_index, $idSubjects[$i], $connect);
            echo "</td><td>";
            echo $gradeo->avg_with_weights();
            //echo round($gradeo->avg_with_weights(), 2);

            echo "</td><td>";
            echo $gradeo->avg_class($connect, $idSubjects[$i], $class)."</td></tr>";
            
            $i++;
        }
        echo "</table></div></div>"; //content

        // for($i = 0; $i<count($idSubjects); $i++){
        //     echo "<br>".$gradeo->avg_class($connect, $idSubjects[$i], $class);
        // }


        //echo "<br>".$gradeo->avg_class($avg, $connect, $subject);


    }

    ?>
</body>
</html>