<?php 


class Grade {
            public $grades = [];
            public $weights = [];
            private $ile;
            public $averages = [];
            

            function grades ($user,$sub, $connect){
                $sql_ang = "SELECT *
                        FROM grades g
                        JOIN subject sb ON g.fk_id_subject = sb.id_subject
                        WHERE g.fk_id_student = '$user' AND sb.id_subject = '$sub';";
                        $res_ang = $connect->query($sql_ang);
                        $grades = [];
                        $weights = [];
                        $grade_ids = [];
                        $types = [];
                        $ile = 0;
                        if($res_ang->num_rows>0){
                            
                            while($row = $res_ang->fetch_assoc()){
                                $grades[] = $row['grade'];
                                $weights[] = $row['weight'];
                                $date[] = $row['date_of_issue'];
                                $types[] = $row['type'];
                                $ids_grade[] = $row['id_grade'];
                                $ile = count($grades);
                            }
                            $i = 0;
                            foreach($grades as $grade){
                                echo "<span class='grade' title='".$types[$i]."\nData: ".$date[$i]."\nWaga: ".$weights[$i]."'>
                                <a href='grade_details.php?id_grade=".$ids_grade[$i]."'>".$grade." </a>
                                </span>"; 
                                $i++;
                            }
                            
                            //onmouseover="this.className='yellowThing';"
                            //echo $ile;
                        }
                        echo " ";
                        $this->grades =  $grades;
                        $this->weights = $weights;
                        $this->ile = $ile;
                        
            }  
            
            
            function avg_a(){  
                if($this->ile > 0){
                $sum = 0;
                for($i = 0; $i<$this->ile; $i++){
                    $sum = $sum + $this->grades[$i];
                }
                $avg = $sum/$this->ile;

                echo round($avg, 2);
            }else
                echo " ";

            }

            function avg_class($connect, $subject, $class){
                
                $sql_costam = "SELECT s.id_student 
                FROM student s 
                JOIN grades g ON S.id_student = G.fk_id_student 
                JOIN subject sb ON g.fk_id_subject = sb.id_subject 
                WHERE s.fk_id_class = '$class' AND sb.id_subject = '$subject' 
                GROUP BY s.id_student 
                HAVING COUNT(g.grade) > 0"; //lista studentów którzy mają chociaż jedną ocenę

                
                $res_costam = $connect->query($sql_costam);
                if($res_costam->num_rows>0){
                    $students_ids = [];
                    while($row = $res_costam->fetch_assoc()){
                        $students_ids[] = $row['id_student'];
                    }

                    $number_of_students = count($students_ids); //liczba studentów którzy mają oceny

                    $licznik = 0;
                    foreach($students_ids as $student){
                        $sql_is_getting_closer = "SELECT sum((g.grade*g.weight))/sum(g.weight) as average
                        FROM grades g 
                        WHERE g.fk_id_student = '$student' AND g.fk_id_subject = '$subject';";

                        
                        $res_is_getting_closer= $connect->query($sql_is_getting_closer);
                        if($res_is_getting_closer->num_rows>0){
                            $roww= $res_is_getting_closer->fetch_assoc();
                            $this->averages[$licznik] = $roww['average'];
                            $licznik++;
                            
                        }
                        
                    
                    }

                    $sum = 0;

                    for($i= 0; $i<$number_of_students; $i++){
                        $sum+=$this->averages[$i];
                    }

                    echo round($sum/$number_of_students, 2);


                }
                
                

            }

            function avg_with_weights(){
                if($this->ile > 0){
                    $sum_up = 0;
                    $sum_down = 0;
                    
                    for($i = 0; $i<$this->ile; $i++){
                        $sum_up = $sum_up + $this->grades[$i] * $this->weights[$i];
                        $sum_down = $sum_down + $this->weights[$i];
                    }
                    
                    
                    return round($avg_w = $sum_up / $sum_down,2);
                    
                    echo round($avg_w, 2);
                }
                
            }

        }


?>