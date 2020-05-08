<?php
    session_start();
    require_once "../conn.php";
    
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
    $teacher_index = $_SESSION['id_user'];

    $sql_teacher = "SELECT s.subject_name, s.id_subject, t.teacher_name
    FROM subject s 
    JOIN teacher t ON s.fk_id_teacher = t.id_teacher 
    WHERE t.id_teacher = '$teacher_index';";
    $result_teacher = $connect->query($sql_teacher);
    
    if($result_teacher->num_rows>0){
        //$row = $result_teacher->fetch_assoc();
        $_SESSION['logged_in'] = true;
        $subjects = [];
  
        
        //$teacher_name = $row['teacher_name'];
        while($row = $result_teacher->fetch_assoc()){
            $subjects[] = $row['subject_name'];
        }
        
        //$ile = count($subjects);
        //echo /*"<p> Siema ".$teacher_name."! Jesteś nauczyciel.".*/$ile;
        

            // foreach ($subjects as $subject){
            //     echo "<h1>".$subject."</h1>";
            // }

            //$_SESSION['subjecta'] = $subjects[0];
        
        //echo "</p>";
        //echo fileperms("nauczyciel.php"); 
            


        $sql_classes = "SELECT  s.id_subject, sic.fk_id_class, s.subject_name
        FROM subject s
        JOIN teacher t ON s.fk_id_teacher = t.id_teacher
        JOIN subjects_in_classes SIC ON s.id_subject = sic.fk_id_subject
        WHERE t.id_teacher = '$teacher_index';";

        $result_classes = $connect->query($sql_classes);
        
            
            
            if($result_classes->num_rows>0){
                //$classes = [];
                //$subjectsa = [];
                while($row = $result_classes->fetch_assoc()){
                    $subjectsa[] = $row['id_subject'];
                    $classes[] = $row['fk_id_class'];
                    
                    
                }
                // foreach ($classes as $c){
                //     echo " <br> ".$c;
                // }
                // foreach ($subjectsa as  $s){
                //     echo " <br> ".$s;
                // }

                $s_counter = 0;
                $c_counter = 0;

                for( $i = 0; $i<count($classes)*2; $i++){
                    if($i%2==0){
                        $together[$i] = $subjectsa[$s_counter];
                        $s_counter++;
                    }else {
                        $together[$i] = $classes[$c_counter];
                        $c_counter++;
                    }
                    
                }
                //echo "<br>".count($together)."<br>";
                echo "<div class='begin-panel'>
                        <h2 style='text-align:center;'>Wybierz klasę</h3>
                            <div class='center-all'>";
                for ($i = 0; $i < count($together); $i++){
                    
                    //echo "<br>".$.": <a href='class.php?value=".$class."'> ".$class."</a><br>";
                    
                    if($i%2==0){
                        if($i >= 2 && $together[$i] == $together[$i-2]){
                            
                        }else if ($i > -1){
                            echo "<br>".$together[$i]; //subject
                        }
                        
                    }else{
                        echo "<div id='button-a'><a href='classOptions.php?class=".$together[$i]."&subject=".$together[$i-1]."''>".$together[$i]."</a></div>"; //class
                    }
                    
                }
                echo "</div></div>";
            }
        

        //$teacher_name = $row['teacher_name'];

    
    }else
        echo "Nie udało się połączyć.";

    ?>

</body>
</html>