
var grade = document.getElementById('grade_up');
var selectType = document.getElementById('types_up');
var selectWeight = document.getElementById('weights_up');

var number_of_students = document.getElementById('number_of_students').innerHTML;


grade.addEventListener('keyup', function(){
    if(grade.value!=0){
        console.log(grade.value);
        for(i = 1; i<=12; i++){
            document.getElementById('grade-class' + i).value = grade.value;
        }
    }
    else{
        for(i = 1; i<=12; i++){
            document.getElementById('grade-class' + i).value = "";
        }
    }
});


selectType.addEventListener('click', function(){
    console.log(selectType.value);
    for(i = 1; i<=number_of_students; i++){
        document.getElementById('type' + i).value = selectType.value;
    }
});

selectWeight.addEventListener('click', function(){
    console.log(selectWeight.value);
    for(i = 1; i<=number_of_students; i++){
        document.getElementById('weight' + i).value = selectWeight.value;
    }
});