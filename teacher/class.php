<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css" type="text/css">
    <title>Document</title>
</head>

<?php

session_start();
require_once "../conn.php";
include('../navigation.php');

class Classa{

    function costam ($student, $connect, $subject){

        $grades = [];
        $weights = [];
        $ile = 0;
        $_SESSION['avg_sum'] = 0;
        $ids_grade = [];
        
        $sql_grades = "SELECT g.grade, g.weight, g.date_of_issue, g.type, g.id_grade
        FROM grades g
        JOIN student s ON g.fk_id_student = s.id_student
        JOIN subject sb ON g.fk_id_subject = sb.id_subject
        WHERE s.id_student = '$student' AND sb.id_subject = '$subject';";

        $res_grades = $connect->query($sql_grades);
        

        if($res_grades->num_rows>0){
                            
            while($row = $res_grades->fetch_assoc()){
                $grades[] = $row['grade'];
                $weights[] = $row['weight'];
                $date[] = $row['date_of_issue'];
                $types[] = $row['type'];
                $ile = count($grades);
                $ids_grade[] = $row['id_grade'];
            }
            $i = 0;
            foreach($grades as $grade){
                echo "<a href='editGrade.php?idgrade=".$ids_grade[$i]."' title='Edytuj ocenę\n".$types[$i]."\nData: ".$date[$i]."\nWaga: ".$weights[$i]."'>".$grade." </a>"; 
                $i++;
            }

        
            
        }
        $this->grades =  $grades;
        $this->weights = $weights;
        $this->ile = $ile;

        
    }

    function avg(){
        if($this->ile>0){
        $sum_up = 0;
        $sum_down = 0;
                    
        for($i = 0; $i<$this->ile; $i++){
            $sum_up = $sum_up + $this->grades[$i] * $this->weights[$i];
            $sum_down = $sum_down + $this->weights[$i];
        }
        return round($avg_w = $sum_up / $sum_down, 2);
        //printf("%f", round($avg_w = $sum_up / $sum_down, 2));
        }
    }
}

$class = $_GET['class'];
$subjecta = $_GET['subject'];


$sql_students_list = "SELECT s.id_student, s.name, s.lastname
                    FROM student s
                    WHERE s.fk_id_class = '$class';";

$res_list = $connect->query($sql_students_list);

    if($res_list->num_rows>0){
        $students = [];
        while($row = $res_list->fetch_assoc()){
            $students_names[] = $row['name'];
            $students_lastnames[] = $row['lastname'];
            $students_ids[] = $row['id_student'];
        }

        for( $i = 0; $i<count($students_names); $i++){
            $students[$i] = $students_names[$i]." ".$students_lastnames[$i];
        }


        echo "<div class='grades-panel'>";
        echo "<h4 style='text-align:center; padding-bottom:30px; font-size:1.8em'>".$subjecta." - klasa ".$class."</h4>
        <table style='margin:20px'>
        <tr>
        <th>Uczeń</th>
        <th>Oceny</th>
        <th>Średnia</th>
        </tr>";
        $classeo = new Classa();
        $i = 0;
        $averages_c = [];
        foreach($students as $student){
            echo "<tr><td>".$student."</td> <td id='grade-column'>";
            echo  $classeo->costam($students_ids[$i], $connect, $subjecta)."</td><td>";
            $averages_c[$i] = $classeo->avg();
            echo $averages_c[$i]."</td></tr>";
            $i++;
        }
        echo "</table></div>";


        // $_SESSION['averages_sum'] = 0;
        // for( $i = 0; $i<count($averages_c); $i++){
        //     $_SESSION['averages_sum'] +=$averages_c[$i];
        // }
        // echo $_SESSION['averages_sum'];
    }









?>