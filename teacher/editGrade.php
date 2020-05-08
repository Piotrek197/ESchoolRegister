<head>
    <link rel="stylesheet" href="../styles/style.css">
</head>


<?php
session_start();
require_once "../conn.php";
include('../navigation.php');

$id_grade = $_GET['idgrade'];

$res = $connect->query("SELECT g.grade, g.type, g.weight FROM grades g WHERE g.id_grade = '$id_grade';");



if($res->num_rows >0){
    $row = $res->fetch_assoc();
    $grade = $row['grade'];
    $type = $row['type'];
    $weight = $row['weight'];
}







$message = "";
if(isset($_POST['submit-btn'])){
    $Editedgrade = $_POST['edited_grade'];
    $Editedtype = $_POST['edited_type'];
    $Editedweight = $_POST['edited_weight'];

    if(preg_match('/[1-6]/', $Editedgrade)){
        
    $sql_edit = "UPDATE grades g SET grade='$Editedgrade', type='$Editedtype', weight='$Editedweight' WHERE g.id_grade='$id_grade';";
    $res_edit = $connect->query($sql_edit); 
    $grade = $Editedgrade;
    $type = $Editedtype;
    $weight = $Editedweight;
    $message = "<span style='color:green;'>Udało się pomyślnie zmienić ocenę.</span>";
    }else
    $message = "<span style='color:red;'>Złe dane!</span>";

}

if(isset($_POST['submit-delete'])){
      
    
    //$sql_delete = "UPDATE grades g SET grade='$Editedgrade', type='$Editedtype', weight='$Editedweight' WHERE g.id_grade='$id_grade';";
    if($res_delete = $connect->query("DELETE FROM `grades` WHERE `grades`.`id_grade` = '$id_grade'")){
        $grade = "";
        $type = "";
        $weight = "";
        $message = "<span style='color:green;'>Udało się usunąć ocenę.</span>";
    }else
        $message = "<span style='color:red;'>Nie udało się usunąć oceny.</span>";


}

$types = [];
$weights = [];
$res_grades = $connect->query("SELECT sum(g.grade), g.type FROM grades g GROUP BY g.type");
$res_ = $connect->query("SELECT sum(g.grade), g.type FROM grades g GROUP BY g.type");

while ($row_grades = $res_grades->fetch_assoc()){
    $types[] = $row_grades['type'];
    //$weights[] = $row_all['weight'];
}
$weights = array(1, 1.5, 0.75, 0.5, 0.75, 0.25, 1.3, 0.9);

for($i = 0; $i<count($types); $i++){
    if($types[$i] == $type){
        unset($types[$i]);
    }
}
for($i = 0; $i<count($weights); $i++){
    if($weights[$i] == $weight){
        unset($weights[$i]);
    }
}

echo '

<div class="begin-panel">
    <div class="center-all">
        <h3 style="text-align:center;">Edytuj ocenę</h3>

            <form method="post">
            <div>
                <div class="left">
                    <label for="egrade" id="egrade_l">Ocena: </label><br/>
                    <label for="etype" id="etype_l">Typ: </label><br/>
                    <label for="eweight" id="eweight_l">Waga: </label>
                </div>
                <div class="right">
                    <input type="number" id="egrade" name="edited_grade" min="1" max="6" value="'.$grade.'" autocomplete="off"><br/>
                    <select name="edited_type" id="etype">
                        <option selected="selected">'.$type.'</option>';
                        foreach($types as $etype){
                            echo '<option>'.$etype.'</option>';
                        }
                        echo '
                    </select><br/>
           
                    <select id="eweight" name="edited_weight" value='.$weight.'>
                        <option selected="selected">'.$weight.'</option>';   
                        foreach($weights as $eweight){
                            echo '<option>'.$eweight.'</option>';
                        }
                    echo '    
                    </select><br/>
                </div>
            </div>
            <input type="submit" value="Zmień" name="submit-btn" class="btn-editgrade">
            <input type="submit" value="Usuń" name="submit-delete" onclick=" return confirmation();" class="btn-editgrade"> 
            </form>

    ';
echo $message.'
    </div>
</div>';

?>

<script src="../js/editgrade.js"></script>


<style>

.begin-panel .center-all .left,
.begin-panel .center-all .right{
    display:inline-block;
}

.begin-panel .center-all .right{
    margin-left:20px;
}

</style>